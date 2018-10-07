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

	public function update_xray($update_id, $approve) {
		$us = UserSummaryModel::where('user_id', $update_id)->first();
		$us->xray_approve = $approve;
		$us->save();
	}

	public function update_lab($update_id, $approve) {
		$us = UserSummaryModel::where('user_id', $update_id)->first();
		$us->lab_invent_approve = $approve;
		$us->save();
	}

	public function updateDrugAllergy($update_id, $approve) {
		$us = UserSummaryModel::where('user_id', $update_id)->first();
		$us->allergies_approve = $approve;
		$us->save();
	}

	public function updateChronicDrugs($update_id, $approve) {
		$us = UserSummaryModel::where('user_id', $update_id)->first();
		$us->chronic_drugs_approve	 = $approve;
		$us->save();
	}

}