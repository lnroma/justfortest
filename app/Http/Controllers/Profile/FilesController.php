<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 13.02.18
 * Time: 23:48
 */
namespace  App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
//use Dompdf\FrameReflower\Page;
use App\Model\User\Image\Gallery;
use App\Model\User\Image\Gallery\Directory;
use Dompdf\FrameReflower\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    private $_distinationPath = null;

    /**
     * check auntification
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * upload files
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            $request
                ->file('file')
                ->move(
                    $this->_getDistinationPath(),
                    $request->file('file')->getClientOriginalName()
                );
            // url
            $url = $this->_getFilePathCdn() . $request->file('file')->getClientOriginalName();

            // default image directory
            if(!$this->_checkDirectory('avatars')->count()) {
                $avatarDirectory = $this->_createDirectory('avatars', 'Мои аватарки');
            } else {
                $avatarDirectory = $this->_getDirectory('avatars')->first();
            }

            if(!$this->_checkDirectory('all')->count()) {
                $directory = $this->_createDirectory('all', 'Общие файлы');
            } else {
                $directory = $this->_getDirectory('all')->first();
            }

            // image gallery
            $image = new Gallery();
            $image->name = $request->get('title');
            $image->description = $request->get('text');
            $image->filename = $request->file('file')->getClientOriginalName();
            $image->cdn_key = $url;
            $image->user_id = Auth::user()->id;

            if (Auth::user()->gallery->count()) {
                $image->user_image_gallery_directory_id = $directory->id;
                $image->user_image_gallery_directory_key = $directory->key;
            } else {
                $image->user_image_gallery_directory_id = $avatarDirectory->id;
                $image->user_image_gallery_directory_key = $avatarDirectory->key;
            }

            $image->save();
        }

        return back();
    }

    /**
     * set avatar to profile
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setAvatars($id)
    {
        $newAvatar = Gallery::find($id);
        // get avatar directories
        $avatarDirectory = $this->_getDirectory('avatars')->first();
        $allDirectory = $this->_getDirectory('all')->first();
        // get old avatar
        $oldAvatar = Auth::user()->getAvatar();
        $oldAvatar->user_image_gallery_directory_id = $allDirectory->id;
        $oldAvatar->user_image_gallery_directory_key = $allDirectory->key;

        $oldAvatar->save();

        $newAvatar->user_image_gallery_directory_id = $avatarDirectory->id;
        $newAvatar->user_image_gallery_directory_key = $avatarDirectory->key;

        $newAvatar->save();

        return back();
    }

    public function showImages($id)
    {
        $gallery = Gallery::find($id);
        return view('images/show')->with('image', $gallery);
    }

    public function commentImages($id, Request $request)
    {
        $gallery = Gallery::find($id);

        $comment = new Gallery\Comment();
        $comment->user_image_gallery_id = $gallery->id;
        $comment->user_id = Auth::user()->id;
        $comment->title = 'Коментарий к фотографии ' . $gallery->name;
        $comment->text = $request->get('message');
        $comment->save();
        return redirect()->back()->with('message', 'Ваш комментарий добавлен к фотографии пользователя');
    }

    /**
     * create directory
     *
     * @param $directory
     * @param $title
     * @return bool
     */
    protected function _createDirectory($directoryKey, $title)
    {
        $directory = new Directory();
        $directory->user_id = Auth::user()->id;
        $directory->title = $title;
        $directory->key = $directoryKey;
        $directory->value = $directoryKey;
        $directory->save();
        return $directory;
    }

    /**
     * check exist directory
     *
     * @return mixed
     */
    protected function _checkDirectory($directory)
    {
        $directory = $this->_getDirectory($directory);
        return $directory->get();
    }

    /**
     * @param $directory
     * @return Builder
     */
    protected function _getDirectory($directory)
    {
        $directory = Directory::where('user_id', Auth::user()->id)->where('key', $directory);
        return $directory;
    }
    /**
     * get distination file path
     *
     * @return null|string
     */
    protected function _getDistinationPath()
    {
        if($this->_distinationPath != null) {
            return $this->_distinationPath;
        }
        $this->_distinationPath = public_path() . '/files/' . Auth::user()->id . '/';
        return $this->_distinationPath;
    }

    public function _getFilePathCdn()
    {
        return '/files/' . Auth::user()->id . '/';
    }
}