<?php declare(strict_types=1);

namespace App\Actions\Api\Company;

use App\Models\Company;
use App\Models\User;

class AttachUserAction
{
    public function run(Company $company, User $user): array
    {
        //check if the user is already attached to the company . If not attach the user to the company else detach the user from the company
        try{
            if($company->users->contains($user)){
                $company->users()->detach($user);
                $message = 'User detached from company '.$company->name.' successfully';
                $action = 'detach';
            }else{
                $company->users()->attach($user);
                $message = 'User attached to company '.$company->name.' successfully';
                $action = 'attach';
            }
            return ['message' => $message, 'action' => $action];
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}