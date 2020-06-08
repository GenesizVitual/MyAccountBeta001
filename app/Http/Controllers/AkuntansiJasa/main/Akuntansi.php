<?php

namespace App\Http\Controllers\AkuntansiJasa\main;

use App\Model\AkuntansiJasa\Akun;
use App\Model\AkuntansiJasa\AkunTransaksi;
use App\Http\Controllers\Controller;
use App\Model\AkuntansiJasa\Jurnal;
use App\Model\AkuntansiJasa\JurnalTransaksiAkun;
use App\Http\Controllers\CustomClass\AkuntansiJasa\JurnalUmum;
use Illuminate\Http\Request;
use Session;
class Akuntansi extends Controller
{
    public static $proses="default";

    //
    public function index(){
        JurnalUmum::$id_bisnis = Session::get('id_bisnis');
        JurnalUmum::$ketegori_jurnal = array(1);
        $data = JurnalUmum::JurnalUmum('');
        return view('AkuntansiJasa.main.Akuntansi.view', array('data'=> $data));
    }

    public function create(){
        return view('AkuntansiJasa.main.Akuntansi.new');
    }

    public function store(Request $req){

        $model = new Jurnal();
        $model->tgl_transaksi = $req->tgl_transaksi;
        $model->kode = $req->kode;
        $model->transaksi = $req->transaksi;
        $model->kategori_jurnal = $req->kategori_jurnal;
        $model->id_bisnis = Session::get('id_bisnis');
       if($model->save()){
            $req->session()->flash('message_success','Anda telah membuat Jurnal');
            return redirect('detail-jurnal/'.$model->id);
        }
    }

    public function detail_jurnal($id_jurnal){
        JurnalUmum::$id_jurnal = $id_jurnal;
        JurnalUmum::$ketegori_jurnal = array(1);
        JurnalUmum::$id_bisnis = Session::get('id_bisnis');
        $data = JurnalUmum::JurnalUmum('');
        $akun = Akun::all();
        return view('AkuntansiJasa.main.Akuntansi.detail_jurnal',array('data'=> $data, 'data_akuns'=>$akun,'proses'=>self::$proses,'id_jurnal'=>$id_jurnal));
    }

    public function create_akun($id_jurnal){
        self::$proses = "create";
        return $this->detail_jurnal($id_jurnal);
    }

    public function store_akun(Request $req, $id_jurnal){
        $data_jurnal = Jurnal::findOrFail($id_jurnal);
        $model_akun = new JurnalTransaksiAkun();
        $model_akun->jurnal_id = $data_jurnal->id;
        $model_akun->akun_transaksi_id = $req->akun_transaksi_id;
        $model_akun->jum_debet = $req->jum_debet;
        $model_akun->jum_kredit = $req->jum_kredit;
        $model_akun->id_bisnis = $data_jurnal->id_bisnis;
        $model_akun->tgl_jurnal = $data_jurnal->tgl_transaksi;
        $model_akun->kategori_jurnal = $data_jurnal->kategori_jurnal;
        if($model_akun->save()){
            $req->session()->flash('message_success', 'Anda telah berhasil menambahkan akun');
            return redirect('detail-jurnal/'.$id_jurnal);
        }
        $req->session()->flash('message_fail', 'Anda telah gagal menambahkan akun');
        return redirect('detail-jurnal/'.$id_jurnal);
    }

    public function update_akun(Request $req, $id_jurnal){
        foreach ($req->akun_id as $key=> $id_akun){
            $model_akun = JurnalTransaksiAkun::findOrFail($id_akun);
            $model_akun->akun_transaksi_id = $req->akun_transaksi_id[$key];
            $model_akun->jum_debet = $req->jum_debet[$key];
            $model_akun->jum_kredit = $req->jum_kredit[$key];
            $model_akun->save();
        }
        $req->session()->flash('message_success', 'Anda telah berhasil mengubah akun');
        return redirect('detail-jurnal/'.$id_jurnal);
    }

    public function delete_akun(Request $req, $id_akun)
    {
        $model = JurnalTransaksiAkun::findOrFail($id_akun);
        if($model->delete()){
            $req->session()->flash('message_success', 'Anda telah menghapus akun');
            return redirect('detail-jurnal/'.$model->jurnal_id);
        }
    }

}
