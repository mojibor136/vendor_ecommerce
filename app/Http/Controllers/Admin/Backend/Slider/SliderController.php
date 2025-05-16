<?php

namespace App\Http\Controllers\Admin\Backend\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller {
    public function mainSliderIndex() {
        $sliders = Slider::where( 'type', 'main' )->paginate( 10 );
        return view( 'admin.backend.slider.main.index', compact( 'sliders' ) );
    }

    public function mainSliderCreate() {
        return view( 'admin.backend.slider.main.create' );
    }

    public function deleteMainImage( Slider $slider ) {
        try {
            if ( $slider->images && \Storage::disk( 'public' )->exists( $slider->images ) ) {
                \Storage::disk( 'public' )->delete( $slider->images );
            }

            $slider->delete();

            return back()->with( 'success', 'Slider image and record deleted successfully.' );
        } catch ( \Exception $e ) {
            return back()->with( 'error', 'Failed to delete slider: ' . $e->getMessage() );
        }
    }

    public function mainSliderStore( Request $request ) {
        try {
            $countMainImages = Slider::where( 'type', 'main' )->count();

            if ( $countMainImages >= 3 ) {
                return back()->with( 'error', 'You cannot add more than 3 main slider images.' );
            }

            $request->validate( [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',

                    function ( $attribute, $value, $fail ) {
                        $imageInfo = getimagesize( $value );
                        if ( !$imageInfo ) {
                            return $fail( "The $attribute is not a valid image." );
                        }
                        $width = $imageInfo[ 0 ];
                        $height = $imageInfo[ 1 ];
                        if ( $width != 1200 || $height != 600 ) {
                            return $fail( 'Image must be exactly 1200x600 pixels.' );
                        }
                    }
                ],
                'link' => 'nullable|string|max:255',
            ] );

            $image = $request->file( 'image' );
            $fileName = Str::random( 7 ) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs( 'sliders', $fileName, 'public' );

            Slider::create( [
                'images' => $path,
                'type' => 'main',
                'link' => $request->link,
                'author_id' => auth()->guard( 'admin' )->id(),
                'author_type' => get_class( auth()->guard( 'admin' )->user() ),
                'status' => 1,
            ] );

            return redirect()->route( 'slider.main.index' )->with( 'success', 'Slider created successfully.' );
        } catch ( \Exception $e ) {
            return back()->with( 'error', 'Something went wrong: ' . $e->getMessage() );
        }
    }

    public function subSliderIndex() {
        $sliders = Slider::where( 'type', 'sub' )->paginate( 10 );
        return view( 'admin.backend.slider.sub.index', compact( 'sliders' ) );
    }

    public function subSliderCreate() {
        return view( 'admin.backend.slider.sub.create' );
    }

    public function subSliderStore( Request $request ) {
        try {
            $countMainImages = Slider::where( 'type', 'sub' )->count();

            if ( $countMainImages >= 2 ) {
                return back()->with( 'error', 'You cannot add more than 2 sub slider images.' );
            }

            $request->validate( [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',

                    function ( $attribute, $value, $fail ) {
                        $imageInfo = getimagesize( $value );
                        if ( !$imageInfo ) {
                            return $fail( "The $attribute is not a valid image." );
                        }
                        $width = $imageInfo[ 0 ];
                        $height = $imageInfo[ 1 ];
                        if ( $width != 600 || $height != 300 ) {
                            return $fail( 'Image must be exactly 600x300 pixels.' );
                        }
                    }
                ],
                'link' => 'nullable|string|max:255',
            ] );

            $image = $request->file( 'image' );
            $fileName = Str::random( 7 ) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs( 'sliders', $fileName, 'public' );

            Slider::create( [
                'images' => $path,
                'type' => 'sub',
                'link' => $request->link,
                'author_id' => auth()->guard( 'admin' )->id(),
                'author_type' => get_class( auth()->guard( 'admin' )->user() ),
                'status' => 1,
            ] );

            return redirect()->route( 'slider.sub.index' )->with( 'success', 'Slider created successfully.' );
        } catch ( \Exception $e ) {
            return back()->with( 'error', 'Something went wrong: ' . $e->getMessage() );
        }
    }

}
