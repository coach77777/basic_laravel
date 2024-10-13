<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = Portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all', compact('portfolio'));
        // }End Method
    }
    public function AddPortfolio()
    {

        return view('admin.portfolio.portfolio_add');
    } // End Method

    public function StorePortfolio(Request $request)
    {
        $request->validate([

            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],
            [
                'portfolio_name.required' => 'Please Input Portfolio Name',
                'portfolio_title.required' => 'Please Input Portfolio Title',
            ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

        Image::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);
        $save_url = 'upload/portfolio/' . $name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Portfolio Inserted with Image Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.portfolio')->with($notification);
    } // End Method

    public function EditPortfolio($id)
    {

        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    } // End Method

    public function DeletePortfolio($id)
    {

        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);

        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Portfolio Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function PortfolioDetails($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));
    } // End Method

}