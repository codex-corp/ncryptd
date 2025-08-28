<?php
/*
.---------------------------------------------------------------------------.
| License does not expire.                                                  |
| Can be used on 1 site, 1 server                                           |
| Source-code or binary products cannot be resold or distributed            |
| Commercial/none use only                                                  |
| Unauthorized copying of this file, via any medium is strictly prohibited  |
| ------------------------------------------------------------------------- |
| Cannot modify source-code for any purpose (cannot create derivative works)|
'---------------------------------------------------------------------------'
*/

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Copyright © 2013 CODEXC.COM
 * @version 4.1 RC1
 * @access private
 * @license http://www.binpress.com/license/view/l/9f75712c904c6fae3ed66dc3d620f19f license for commercial use
 */

namespace Controllers\Cpanel;

use CpanelController;

use Validator;
use Input;
use Redirect;
use ScubaClick\Pages\Models\Category;
use ScubaClick\Pages\Models\Page;
use View;
use Debugbar;
use Language;

class PageController extends CpanelController {

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $data['pages'] = Page::orderBy('category_id', 'asc')->get();
        $data['languages'] = Language::all();

        $this->layout->content = View::make('admin.pages.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $data['languages'] = Language::all();
        $data['pages'] = Page::where("category_id",'=',0)->orWhereNull("category_id")->get();

        $this->layout->content = View::make('admin.pages.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'    => 'required',
            'content'    => 'required',
            'status'    => 'required',
            'lang_id'    => 'required'
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try{
            $page = new Page(array(
                'user_id'  => Input::get('user_id'),
                'title' => Input::get('title'),
                'content'  => Input::get('content'),
                'status'  => Input::get('status'),
                'slug'  => Input::get('slug'),
                'static'  => Input::get('mode'),
                'front'  => Input::get('front'),
                'lang_id'  => Input::get('lang_id'),
                'category_id'  => Input::get('category_id'),
                'description'  => Input::get('description'),
                'email_to'  => Input::get('email_to'),
                'email_cc'  => Input::get('email_cc')
            ));

            // And don't forget to save!
            $page->save();

        }catch (InvalidArgumentException $e){

        }
        return Redirect::to("admin/page")->with('flash_error', 'the page was added successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $data['id'] = $id;

        $data['page'] = Page::find($id);

        $data['pages'] = Page::orderBy('id', 'asc')->lists('title','id');

        $data['languages'] = Language::orderBy('id', 'asc')->lists('title','id');

        $this->layout->content = View::make('admin.pages.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $page = Page::find($id);

        $page->user_id = Input::get('user_id');
        $page->title = Input::get('title');
        $page->content = Input::get('content');
        $page->status = Input::get('status');
        $page->slug = Input::get('slug');
        $page->lang_id = Input::get('lang_id');
        $page->front =  Input::get('front');
        $page->category_id = Input::get('category_id');
        $page->description = Input::get('description');
        $page->static = Input::get('mode');
        $page->email_to = Input::get('email_to');
        $page->email_cc =  Input::get('email_cc');

        $page->update();

        return Redirect::back()->with('flash_error', 'the page was updated successfully');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //keep in mind i can enable soft delete by use delete()
        Page::find($id)->forceDelete();
        return Redirect::back()->with('flash_error', 'the Page was deleted successfully');
	}


}