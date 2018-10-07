<?php

namespace App\Traits;
use App\UserSummary AS UserSummaryModel;


trait UserSummary {

	public function create_profile($user_id) {
		$us = new UserSummaryModel();
		$us->user_id = $user_id;
		$us->save();
	}

	public function update_cd($update_id, $approve) {

		$us = UserSummaryModel::where('user_id', $update_id)->first();
		$us->chronic_diseases_approve = $approve;
		$us->save();

	}

}