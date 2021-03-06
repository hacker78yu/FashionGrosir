<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->isonline) {
            redirect('login');
        }
    }

    public function get($orders_noid)
    {
        $this->data->orders_noid = $orders_noid;
        $this->data->orders = $this->order->with_order_detil()->where_orders_noid($orders_noid)->get();
        $this->data->orders_total = function () {
            $hasil = 0;
            foreach ($this->data->orders->order_detil as $order) {
                $hasil += $order->orders_detil_tharga;
            }
            return $hasil;
        };


        $this->data->pengiriman = function () {
            $hasil = new stdClass();
            $order_pengiriman = $this->order_pengiriman->where('orders_noid', $this->data->orders_noid)->get();
            $hasil->provinsi = $this->provinsi
                ->where('provinsi_id', $order_pengiriman->orders_pengiriman_provinsi)
                ->get()->provinsi_nama;
            $hasil->kabupaten = $this->kabupaten
                ->where('kabupaten_id', $order_pengiriman->orders_pengiriman_kabupaten)
                ->get()->kabupaten_nama;
            $hasil->kecamatan = $this->kecamatan
                ->where('kecamatan_id', $order_pengiriman->orders_pengiriman_kecamatan)
                ->get()->kecamatan_nama;
            $hasil->desa = $this->desa
                ->where('desa_id', $order_pengiriman->orders_pengiriman_desa)
                ->get()->desa_nama;


            return $order_pengiriman->orders_pengiriman_deskripsi . '<br>' . $hasil->desa . '<br>' . $hasil->kecamatan . ', ' . $hasil->kabupaten . '<br>' .
                $hasil->provinsi . ', ' . $order_pengiriman->orders_pengiriman_kodepos;

        };

        $this->data->nama_nomor = function () {
            $order_pengiriman = $this->order_pengiriman->where('orders_noid', $this->data->orders_noid)->get();
            $hasil = new stdClass();
            $hasil->nama = $order_pengiriman->orders_pengiriman_r_nama;
            $hasil->kontak = $order_pengiriman->orders_pengiriman_r_kontak;

            return $hasil->nama . '<br>' . $hasil->kontak;
        };

        $this->data->jasa = function () {
            $ongkir = $this->order_ongkir->where('orders_noid', $this->data->orders_noid)->get();

            return $ongkir->orders_ongkir_nama . ' - ' . $ongkir->orders_ongkir_deskripsi . ' (' . $ongkir->orders_ongkir_estimasi . ' hari)';
        };

        $this->data->metode_pembayaran = function () {
            $orders_noid = $this->order
                ->where('orders_noid', $this->data->orders_noid)
                ->get()->orders_noid;
            $pembayaran = $this->order_payment->with_bank()->where('orders_noid', $orders_noid)->get()->bank;

            return $pembayaran->bank_penerbit . ' - (A/N: ' . $pembayaran->bank_nama . ') (Nomor Rek: ' . $pembayaran->bank_rek . ')';
        };

        $this->data->biaya_subtotal = function () {
            $hasil = 0;
            $orders_noid = $this->order
                ->where('orders_noid', $this->data->orders_noid)
                ->get()->orders_noid;
            foreach ($this->order_detil->where('orders_noid', $orders_noid)->get_all() as $od) {
                $hasil += (int)$od->orders_detil_tharga;
            }

            return $hasil;
        };

        $this->data->biaya_pengiriman = function () {
            $orders_noid = $this->order
                ->where('orders_noid', $this->data->orders_noid)
                ->get()->orders_noid;
            $ongkir = $this->order_ongkir->where('orders_noid', $orders_noid)->get();
            return (int)$ongkir->orders_ongkir_biaya;
        };

        if ($this->data->orders->orders_status == 7) {
            $this->data->gagal = 'Order tidak ada atau telah dibatalkan.';
            $this->session->set_flashdata('gagal', $this->data->gagal);
            redirect('/');
        }

        $this->load->view('Konfirmasi', $this->data);
    }


    public function simpan()
    {
        $orders_noid = $this->uri->segment(2);
        $order_bukti = $this->order_bukti->where('orders_noid', $orders_noid)->get();

        //upload an image options
        $config = array();
        $config['upload_path'] = './upload';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->do_upload('bukti_pembayaran');
        $hasil = $this->upload->data();


        $konfirmasi_array = array(
            'orders_bukti_nama_rek' => $this->input->post('rek_atasnama'),
            'orders_bukti_no_rek' => $this->input->post('nomor_rekening'),
            'orders_bukti_bank_nama' => $this->input->post('bank'),
            'orders_bukti_nominal' => $this->input->post('total_pembayaran'),
            'orders_bukti_foto' => $hasil['file_name'],
            'orders_noid' => $orders_noid
        );

        if ($order_bukti) {
            // update
            $this->order_bukti->update($konfirmasi_array, 'orders_noid');
            $this->order->where('orders_noid', $orders_noid)->update(array('orders_status' => 3));
            redirect('checkout/' . $this->uri->segment(2) . '/sukses');
        } else {
            // insert
            $this->order_bukti->insert($konfirmasi_array);

            $this->order->where('orders_noid', $orders_noid)->update(array('orders_status' => 3));
            redirect('checkout/' . $this->uri->segment(2) . '/sukses');
        }


    }

    public function sukses()
    {
        $this->data->orders_noid = $this->uri->segment(2);
        $this->data->orders = $this->order->with_order_detil()->where_orders_noid($this->data->orders_noid)->get();
        $this->data->orders_total = function () {
            $hasil = 0;
            foreach ($this->data->orders->order_detil as $order) {
                $hasil += $order->orders_detil_tharga;
            }
            return $hasil;
        };

        $this->data->pengiriman = function () {
            $hasil = new stdClass();
            $order_pengiriman = $this->order_pengiriman->where('orders_noid', $this->data->orders_noid)->get();
            $hasil->provinsi = $this->provinsi
                ->where('provinsi_id', $order_pengiriman->orders_pengiriman_provinsi)
                ->get()->provinsi_nama;
            $hasil->kabupaten = $this->kabupaten
                ->where('kabupaten_id', $order_pengiriman->orders_pengiriman_kabupaten)
                ->get()->kabupaten_nama;
            $hasil->kecamatan = $this->kecamatan
                ->where('kecamatan_id', $order_pengiriman->orders_pengiriman_kecamatan)
                ->get()->kecamatan_nama;
            $hasil->desa = $this->desa
                ->where('desa_id', $order_pengiriman->orders_pengiriman_desa)
                ->get()->desa_nama;


            return $order_pengiriman->orders_pengiriman_deskripsi . '<br>' . $hasil->desa . '<br>' . $hasil->kecamatan . ', ' . $hasil->kabupaten . '<br>' .
                $hasil->provinsi . ', ' . $order_pengiriman->orders_pengiriman_kodepos;

        };

        $this->data->nama_nomor = function () {
            $order_pengiriman = $this->order_pengiriman->where('orders_noid', $this->data->orders_noid)->get();
            $hasil = new stdClass();
            $hasil->nama = $order_pengiriman->orders_pengiriman_r_nama;
            $hasil->kontak = $order_pengiriman->orders_pengiriman_r_kontak;

            return $hasil->nama . '<br>' . $hasil->kontak;
        };

        $this->data->jasa = function () {
            $ongkir = $this->order_ongkir->where('orders_noid', $this->data->orders_noid)->get();
            return $ongkir->orders_ongkir_nama . ' - ' . $ongkir->orders_ongkir_deskripsi . ' (' . $ongkir->orders_ongkir_estimasi . ' hari)';
        };

        $this->data->metode_pembayaran = function () {
            $orders_noid = $this->order
                ->where('orders_noid', $this->data->orders_noid)
                ->get()->orders_noid;
            $pembayaran = $this->order_payment->with_bank()->where('orders_noid', $orders_noid)->get()->bank;

            return $pembayaran->bank_penerbit . ' - (A/N: ' . $pembayaran->bank_nama . ') (Nomor Rek: ' . $pembayaran->bank_rek . ')';
        };

        $this->data->biaya_subtotal = function () {
            $hasil = 0;
            $orders_noid = $this->order
                ->where('orders_noid', $this->data->orders_noid)
                ->get()->orders_noid;
            foreach ($this->order_detil->where('orders_noid', $orders_noid)->get_all() as $od) {
                $hasil += (int)$od->orders_detil_tharga;
            }

            return $hasil;
        };

        $this->data->biaya_pengiriman = function () {
            $orders_noid = $this->order
                ->where('orders_noid', $this->data->orders_noid)
                ->get()->orders_noid;
            $ongkir = $this->order_ongkir->where('orders_noid', $orders_noid)->get();
            return (int)$ongkir->orders_ongkir_biaya;
        };

        $order = $this->order->where('orders_noid', $this->uri->segment(2))->get();
        if ($order->orders_status == 3) {
            $this->load->view('Konfirmasi_sukses', $this->data);
        }
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */