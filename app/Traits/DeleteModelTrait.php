<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteModelTrait {
    public function deleteModelTrait($id, $model)
    {
        try {
            $model->findOrfail($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Xoá thành công'
            ], 200);

        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Xoá thất bại'
            ], 500);
        }
    }
}
