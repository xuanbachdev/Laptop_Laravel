<?php

namespace App\Traits;
trait StorageImageTrait{
    public function storageTraitUpload($request,$fieldName,$folderName){
        if($request -> hasFile($fieldName)){
            try {
                $file = $request-> $fieldName;
                $filenameOrigin = $file->getClientOriginalName();
                $filenameHash = \Str::random(20) .'.' . $file->getClientOriginalExtension();
                $filepath = $request->file($fieldName)->storeAs('public/' . $folderName. date('d-m-Y'),$filenameHash);
                $dataUploadTrait = [
                    'file_name' => $filenameOrigin,
                    'file_path' => \Storage::url($filepath)
                ];
                return $dataUploadTrait;
            } catch (Exception $e) {
                return null;
            }
        }
    }


    public function storageTraitUploadMutiple($file, $folderName){
        $filenameOrigin = $file->getClientOriginalName();
        $filenameHash =\Str::random(20) .'.' . $file->getClientOriginalExtension();
        $filepath = $file->storeAs('public/' . $folderName. date('d-m-Y')  ,$filenameHash);
        $dataUploadTrait = [
            'file_name' => $filenameOrigin,
            'file_path' => \Storage::url($filepath)
        ];
        return $dataUploadTrait;
    }
}
