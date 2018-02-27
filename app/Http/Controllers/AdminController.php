<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Student;
use App\Company;
use Validator;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function matchindex(Request $request)
    {
      $query = Match::all();
      $studentName = empty($request->$studentName) ? "" : $request->$studentName;
      $companyName = empty($request->$companyName) ? "" : $request->$companyName;
      if ($studentName != ""){
        $query = $query->where("studentName","=",$studentName);
      }
      if ($companyName != ""){
        $query = $query->where("companyName","=",$companyName);
      }
      $items = $query->get();
      return view('admin.matchindex',['items'=>$items]);
    }

    public function matchupdate(Request $qeruest)
    {
      if ($request->isMethod('get')){
        $item = Match::find($request->id);
        $students = DB::table('students')->all();
        $companies = DB::table('companies')->all();
        return view('admin.matchupdate',['item'=>$item,'students'=>$students,'companies'=>$companies]);
      }else {
        $validator = Validator::make($request->all(),Match::$rules,Match::$messages);
        if ($validator->fails()) {
          return redirect('admin.update/'.$request->id)
          ->withErrors($validator)
          ->withInput();
        }
        $item = Match::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $item->fill($form)->save();
        return redirect('admin.matchview'.$request->id);
      }
    }

    public function matchadd(Request $request)
    {
      if ($request->isMethod('get')) {
        $students = DB::table('students')->all();
        $companies = DB::table('companies')->all();
        return view('admin.matchadd',['students'=>$students,'companies'=>$companies]);
      }else {
        $validator = Validator::make($request->all(),Match::$rules,Match::$messages);
        if ($validator->fails()) {
          return redirect('admin.matchadd')
          ->withErrors($validator)
          ->withInput();
        }
        $item = new Macth;
        $form = $request->all();
        unset($form['_token']);
        $item->fill($form)->save();
        return view('admin.matchindex');
      }
    }

    public function matchview(Request $request)
    {
      $item = Match::find($request->id);
      return view('admin.matchview',['item'=>$item]);
    }

    public function matchdelete(Request $request)
    {
      $item = Match::find($request->id)->delete();
      return view('admin.matchindex');

    }

    public function studentIndex(Request $request)
    {
      //requestのqueryから入力するユーザー名を取得する。
      $student_name = $request->student_name;

      //入力されてない場合は、「""」空文字列を認める。
      $student_name = empty($student_name) ? "" : $student_name;

      //モデルのWhereメソッドを利用し、上記情報を検索する。
      $items = Student::where('name', 'LIKE', "%$student_name%")->paginate(1);

      //検索の結果をテンプレートに渡す。
      return view("admin.student_index", array("items" => $items, "student_name" => $student_name));
    }

/*    public function studentAdd(Request $request)
    {
      return view("admin.student_add",array());
    }
*/
    public function companyIndex(Request $request)
    {
      //requestのqueryから入力するのユーザー名、会社名、Email、給料、分野を取得する。
      $company_username = $request->company_username;

      //入力されてない場合は、「""」空文字列を認める。
      $company_username = empty($company_username) ? "" : $company_username;

      //モデルのWhereメソッドを利用し、上記情報を検索する。
      $items = Company::where('username','LIKE',"%$company_username%")->paginate(3);

      //検索の結果をテンプレートに渡す。


      return view("admin.company_index",array("items" => $items, "company_username" => $company_username));
    }


    public function companyAdd(Request $request)
    {
      //getの場合 会社の新規ページーをレンダル。
        if ($request->isMethod('get'))
        {
          $companys = DB::table('companys')->all();
          return view("admin.company_add",['company'=>$company]);
        }else {
          $validator = Validator::make($request->all(),Company::$rules,Company::$messages);
          if ($validator->fails()) {
            return redirect('admin.companyadd')
            ->withErrors($validator)
            ->withInput();
      //postの場合 requestのpostから会社ユーザー名、会社本名、パスワード、パスワード確認、emailを取得する。
        if($request->isMethod('post'))
        {
          $item = new Macth;
          $form = $request->all();
          unset($form['_token']);
          $item->fill($form)->save();
          return view('admin.companyindex');
        }
      //上記情報をValidatorで検証する。

      //失敗の場合は、エラーメッセージを連れて、本ページを戻す。

      //成功の場合は、新しいDATAをsave()で新規する、詳細ページを戻す。


        return view("admin.company_add",array());
        }
      }
    }
    public function companyEdit(Request $request)
    {
        //getでアクセスするの場合は Routeparameter連れているのIdを取得する。

        //モデルの検索メソッドを利用し、上記情報を検索する。

        //検索の結果をテンプレートに渡す。

        //postでアクセスするの場合は、requestのpostから会社名、パスワード、などの情報を取得する。

        //上記情報をValidatorで検証する。

        //失敗の場合は、エラーメッセージを連れて、本ページを戻す。

        //成功の場合は、新しいDATAをsave()で更新する、詳細ページを戻す。

        return view("admin.company_edit",array());
    }
}
