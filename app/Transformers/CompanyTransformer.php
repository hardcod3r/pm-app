<?php declare(strict_types=1);

namespace App\Transformers;

use App\Abstract\Transformers\BaseTransformer;

class CompanyTransformer extends BaseTransformer
{
    public function transform($company): array
    {
        $data =  [
            'name' => $company->name,
            'country' => $company->country->name,
            'address' => $company->address,
            'vat_number' => $company->vat_id,
            'logo' =>  url($company->logo),
            'website' => $company->website
        ];

        if($company->relationLoaded('projects')) {
            $data['projects'] = (new ProjectTransformer())->transformCollection($company->projects);
        }

        return $data;
    }
}