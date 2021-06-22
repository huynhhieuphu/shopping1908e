<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminBrandPost;
use Illuminate\Support\Facades\DB;
use voku\helper\AntiXSS;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateBrandPost;

class BrandController extends Controller
{
    const LIMITTED_ROW = 3; // thiết lập số dòng trong 1 trang

    public function index(Request $request, AntiXSS $antiXSS)
    {
        // 1 - Hiển thị danh sách
        // 2 - Phân trang
        // 3 - xử lý search
        $data = [];

        $keyword = $request->keyword;
        $keyword = $antiXSS->xss_clean($keyword);
        $key = "%{$keyword}%";

        $data['stateInsert'] = $request->session()->get('stateBrand');
        $data['listBrand'] = DB::table('brands')
            ->where('name','like', $key)
            ->orderByDesc('status')
            ->orderBy('id')
            ->paginate(self::LIMITTED_ROW);

        $data['keyword'] = $keyword;
        return view('admin.brand.index', $data);
    }

    public function add(Request $request)
    {
        return view('admin.brand.add');
    }

    public function handleAdd(AdminBrandPost $request, AntiXSS $antiXSS)
    {
        // 1 - validation
        // 2 - chống xss
        // 3 - insert data vào model bằng query builder

        //dd($request->all());
        $name = $request->nameBrand;
        $description = $request->decrBrand;

        $name = $antiXSS->xss_clean($name);
        $description = $antiXSS->xss_clean($description);

        $insert = DB::table('brands')->insert([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $description,
            'status' => 1,
            'created_at' => date('Y-m-d H:m:i'),
            'updated_at' => null
        ]);

        //$insert = true;

        if ($insert) {
            $request->session()->flash('stateBrand', 'Thêm mới thành công');
            return redirect()->route('admin.brand.index');
        } else {
            $request->session()->flash('stateBrand', 'Thêm mới thất bại');
            return redirect()->route('admin.brand.add');
        }
    }

    public function handleDelete(Request $request)
    {
        // Kiểm tra yêu cầu gửi lên phải ajax không ?
        if ($request->ajax()) {
            $idBrand = $request->idBrand;
            // kiểm tra id gửi lên server có hay không và lớn hay không
            $idBrand = (is_numeric($idBrand) && $idBrand) > 0 ? $idBrand : 0;

            // Khi lấy dữ liệu từ thuộc tính data mặc định kiểu chuỗi
            $statusBrand = $request->statusBrand;
            $statusBrand = ($statusBrand === '0' || $statusBrand === '1') ? $statusBrand : '';

            if ($idBrand !== 0 && $statusBrand !== '') {
                $delete = DB::table('brands')
                    ->where('id', $idBrand)
                    ->update(['status' => $statusBrand]);
                if ($delete) {
                    echo 'success';
                } else {
                    echo 'fail';
                }
            } else {
                echo 'error';
            }
        }
    }

    public function edit(Request $request)
    {
//        dd($request->id);
        $idBrand = $request->id;
        $idBrand = is_numeric($idBrand) && $idBrand > 0 ? $idBrand : 0;

        if ($idBrand !== 0) {
            $dataBrand = DB::table('brands')
                ->where('id', $idBrand)
                ->first();
            if ($dataBrand) {
//                dd($dataBrand);
//                $dataBrand = json_decode(json_encode($dataBrand), true);
                return view('admin.brand.edit', compact('idBrand', 'dataBrand'));
            }
        } else {
            about(404);
        }
    }

    public function handleUpdate(UpdateBrandPost $request)
    {
        //sdd($request->all());

        $idBrand = $request->hddIdBrand;
        $nameBrand = $request->nameBrand;
        $slugBrand = Str::slug($nameBrand);
        $descBrand = $request->decrBrand;
        $sttBrand = $request->sttBrand;
        $sttBrand = $sttBrand == '0' || $sttBrand == '1' ? $sttBrand : 0;

        $update = DB::table('brands')
            ->where('id', $idBrand)
            ->update([
                'name' => $nameBrand,
                'slug' => Str::slug($nameBrand),
                'description' => $descBrand,
                'status' => $sttBrand,
                'updated_at' => date('Y:m:d H:m:i')
            ]);

        if($update){
            $request->session()->flash('stateBrand', 'Cập nhật thành công');
            return redirect()->route('admin.brand.index');
        }else{
            $request->session()->flash('stateBrand', 'Cập nhật thất bại');
            return redirect()->route('admin.brand.edit', ['id' => $idBrand, 'slug' => $slugBrand]);
        }
    }
}
