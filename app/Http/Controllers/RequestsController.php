<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Category;

use Auth;
class RequestsController extends Controller
{
	//note: controller collects stuff from model and work on the model then pass it to a view in form of a variable with the help of importing the model file first as seen above ith use App\Requests

	public function submitRequest(Request $request)
	{

		$this->validate($request, [
    		'request_title' => 'required', 
    		'category_id' => 'required',
    		'body' => 'required',
    		'user_id' => 'required'

    	]);
    	//inserting data
		$requests = new Requests([
			'request_title' => $request->input('request_title'), //colecting value from user from the text box to column names on the right handside
			'category_id' => $request->input('category_id'),
			'body' => $request->input('body'),
			'user_id' => $request->input('user_id')
			]);

		//retrieving data
		$requests->request_title = $request->request_title;
		$requests->category_id = $request->category_id;
		$requests->body = $request->body;
		$requests->user_id = $request->user_id;
		// $requests->user_image = $request->user_image;

		// dd($requests); exit;
		$requests->save();
		return redirect()->route('users.view_request')->with(['message' => 'Request Successfully Posted!']);
	}

	public function viewRequest()
	{
		$user_request = Requests::latest()->paginate(5); //accepting stuffs either txtbox or anytn
		$current_user_mail = Auth::user()->email; //displaying user mail with auth::user i.e d present user online
		$user_id = Auth::user()->id;
		$categories = Category::all();
		$current_user_image = Auth::user()->user_image;
		// dd($categories->id);
		return view('users.view_request', ['current_user_mail' => $current_user_mail, 'categories'=> $categories, 'all_request'=>$user_request, 'current_user_image' => $current_user_image, 'user_id' => $user_id,])->with(['message' => 'Request Successfully Updated']);
	}

	public function getEdit($id)
	{
		// $viewPost = Requests::find($id);
		$viewPost = Requests::find($id);
		return view('users.edit', compact('viewPost'));
		// return view('users.edit');

	}
	// public function postEdit($id)
	// {
	// 	$viewPost = Requests::find($id);
	// 	//return view('users.edit', compact('viewPost'));
	// 	return view('users.edit');

	// }

	public function update(Request $request, $id)
	{
		$this->validate($request,['request_title' => 'required',
			'request_type' => 'required',
			'body', 'required'
		]);
		$user_request = Requests::all();
		return redirect()->route('users.view_request', ['all_request' => $user_request])->with('alert-success', 'Data was successfully saved!');
	}

	public function getDeletePost($post_id){
		$post = Requests::where('id', $post_id)->first(); //first is the first element u can use get as well using first doesnt mater so far its d id column is unique frm oder
		$post->delete();
		return redirect()->route('users.view_request')->with(['message' => 'Request Successfully Deleted']);
	}

	public function Edit(Request $request){
		$method = $request->isMethod('post');
		// dd($method);
		$this->validate($request, [
			// 'id' => 'id',
    		'request_title' => 'required', 
    		'category_id' => 'required',
    		'body' => 'required',
    		'user_id' => 'required'

    	]);
    	//inserting data

		$requests = new Requests([//colecting value from user from the text box
			'id' => $request->input('id'), //colecting value from user from the text box
			'request_title' => $request->input('request_title'),
			'request_type' => $request->input('request_type'),
			'body' => $request->input('body'),
			'user_id' => $request->input('user_id')
			

			]);
		 // dd($requests->id); exit;
		switch ($method) {
		    case true:
		    //algorithm to update
		    //1. Retrieve wat u wana update by using d find method
		    //2. accept d ffields u wana update tru txtbox $request->input('fieldname')
		    //den save it again
		    //3. u run the save method again reason bcus uv selected that particular id by find function
		         $requests = Requests::where('id', $requests->id);
		          $requests->update(
		          	[ 'request_title' => $request->input('request_title'), //colecting value from user from the text box to column names on the right handside
					'request_type' => $request->input('request_type'),
					'body' => $request->input('body'),
					'user_id' => $request->input('user_id')
		          	]);
		          return redirect()->route('users.view_request')->with(['message' => 'Request Successfully Updated']);
		    break;
		    case false:
		        return view('users.view_request');    
		    break;
		    default:
		        return view('users.view_request');    
		    break;
		}
	}

	public function category($id)
	{
		$fetch_category_view = Requests::findOrFail($id);
		
	}

	public function view_each_request($id)
	{
		$view_request = Requests::find($id);
		$all_request = Requests::all();
		$current_user_mail = Auth::user()->email;
		return view('users.view_each_request', ['view_request' => $view_request, 'current_user_mail' => 'current_user_mail']); 
	}

	public function view_each_category($id)
	{
		$request_all = Requests::all();
		$user_request = $request_all->where('category_id', $id);
		$current_user_mail = Auth::user()->email;
		// dd($user_request); exit;
		$categories = Category::all();

		$current_user_image = Auth::user()->user_image;
		$user_id = Auth::user()->id;


		// dd($category);
		// return view('users.view_request', ['all_request' => $user_request]);
		// $displayCategoryDetail = category

		
		return view('users.view_request', ['current_user_mail' => $current_user_mail, 'categories'=> $categories, 'all_request'=>$user_request, 'current_user_image' => $current_user_image, 'user_id' => $user_id,])->with(['message' => 'Request Successfully Updated']);
	}

	public function getSearchResult(Request $request)
	{
		$method = $request->isMethod('post');
		// dd($method);exit;
		switch ($method) {
			case true:
				$search = $request->input('search_field');
				if(!$search){
					return redirect()->route('users.view_request')->with(['error_message'=>'Please! type to search for a request']);
				}
				// $search = DB::table('requests')->leftJoin('categories', 'requests.id', '=', 'categories.id')->get();
				// $join = DB::table('requests', 'categories.categry_name' LEFT JOIN  ); 
				$join = Requests::leftJoin('categories', 'requests.id', '=', 'categories.id')->leftJoin('users', 'requests.user_id', '=', 'users.id')->where('requests.request_title', 'LIKE', '%'.$search.'%')->get();
				// $category = Category::all();
				// dd($join); exit;
				return view('users.someting', ['join' => $join]);
				// dd($join['1']); exit;

				//sometin not compulsory

				break;
			case false:
			
				// return $this->viewRequest();
				break;
			default:
				// return view('users.view_request');
				break;
		}
		
		
	}
	public function searchData($search)
	{
		return $search_Result = DB::table('requests')->where('request_title',$search)
											  ->orWhere('body',$search);									  
	}

	public function monthlyRequest()
	{
		
	}

	public function addNewCategory(Request $request)
	{
		$this->validate($request, 
			['category_name'=>'required|min:4']
			);

		$collectCategory = new Category(
			['category_name' => $request->input('category_name')]
			);
		$collectCategory->save();
		return redirect()->route('users.view_request')->with(['message' => 'Category Successfully Added!.']);
	}

}

