<?php

namespace Gundam\General\Updates;

use Gundam\General\Helper\ApiService;
use Gundam\General\Models\District;
use Gundam\General\Models\Province;
use Gundam\General\Models\Ward;

class SeedArea extends \Seeder
{
    public function run()
    {
        $apiService = new ApiService();
        $data = $apiService->requestGetApi('https://provinces.open-api.vn/api?depth=3');
        if (!empty($data)) {
            foreach ($data as $item) {
                $province = new Province();
                $province->name = $item['name'];
                $province->code = $item['code'];
                $province->codename = $item['codename'];
                $province->phone_code = $item['phone_code'];
                $province->save();

                if (!empty($item['districts'])) {
                    foreach ($item['districts'] as $district) {
                        $districtData = new District();
                        $districtData->name = $district['name'];
                        $districtData->code = $district['code'];
                        $districtData->codename = $district['codename'];
                        $districtData->province_id = $province->id;
                        $districtData->save();

                        if (!empty($district['wards'])) {
                            foreach ($district['wards'] as $ward) {
                                $wardData = new Ward();
                                $wardData->name = $ward['name'];
                                $wardData->code = $ward['code'];
                                $wardData->codename = $ward['codename'];
                                $wardData->district_id = $districtData->id;
                                $wardData->save();
                            }
                        }
                    }
                }
            }
        }
    }
}
