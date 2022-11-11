<?php

namespace App\Traits;

use App\Helpers\File\FileHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use stdClass;

trait ImageTrait
{
    /*
    * Accepted image fields
    */
    protected array $imageFields = [
        'banner',
        'logo',
    ];

    /*
    * Fields that will be updated
    */
    protected array $updatedFields = [];

    /**
     * @param  Model  $model
     * @param  Request  $request
     * @return void
     */
    protected function storeImages(Model $model, Request $request): void
    {
        // Initialize the storage disks
        $disk = App::environment('local') ? 'public' : 's3';
        $this->disk = Storage::disk($disk);
        $path = '/images/'.$model->getTable().'/'.$model->id;

        /* Handle upload process */
        foreach ($this->imageFields as $key) {
            $this->handleUpload($key, $path, $request, $model->$key);
        }

        /* Update fields */
        foreach ($this->updatedFields as $key => $value) {
            $model->$key = $value;
        }

        $model->save();
    }

    /**
     * @param  Model  $model
     * @param  Request  $request
     * @param  string  $key
     * @return void
     */
    protected function storeImage(Model $model, Request $request, string $key = 'image'): void
    {
        // Initialize the storage disks
        $disk = App::environment('local') ? 'public' : 's3';
        $this->disk = Storage::disk($disk);
        $path = '/images/'.$model->getTable().'/'.$model->id;

        /* Handle upload process */
        $this->handleUpload($key, $path, $request, $model->$key);

        /* Update fields */
        $model->$key = $this->updatedFields[$key];

        $model->save();
    }

    /**
     * @param  string  $field
     * @param  string  $path
     * @param  Request  $request
     * @param  string|null  $previous
     * @return void
     */
    protected function handleUpload(string $field, string $path, Request $request, string $previous = null): void
    {
        /* Store image */
        if ($request->filled($field.'_url')) {
            $this->updatedFields[$field] = $request->input($field.'_url');
        } else {
            // Set empty instance
            $file = new stdClass();

            if ($request->file($field.'_literal') instanceof UploadedFile) {
                $file = $request->file($field.'_literal');
            } elseif ($request->filled($field.'_encoded')) {
                $file = FileHelper::fromBase64($request->input($field.'_encoded'));
            }

            // Check instance
            if ($file instanceof UploadedFile) {
                $final = $this->disk->put($path, $file, 'public');
                $this->updatedFields[$field] = $this->disk->url($final);
            }
        }
        /**/

        /* Remove previous image if exist */
        if (! empty($this->updatedFields[$field]) && ! empty($previous)) {
            /* https://www.php.net/manual/en/function.parse-url.php */
            $image = parse_url($previous);

            /* Remove local path (e.g: storage)*/
            $image['path'] = App::environment('local')
                ? str_replace('/storage/', '', $image['path'])
                : $image['path'];

            if (! empty($image['path']) && $this->disk->exists($image['path'])) {
                $this->disk->delete($image['path']);
            }
        }
        /**/
    }
}
