<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Excel;
use Illuminate\Http\Request;
use App\exceldata;
use DB;


class ExcelController extends Controller
{

	
	// redirect to importexport blade 
    public function importExport()
	{
		return view('importexport');
	}
	// redirect to record blade 
	public function recordForm()
	{
		// sending the event_id to the add Record form 
		$even_id =DB::table('exceldatas')->distinct()->get(['event_id']);
		return view('recordform')->with('event_id',$even_id);
	}

    
	  // show modelview of the signle recored
	  public function modelView($id)
	  {
		$record = exceldata::find($id);
		// $record = DB::table('exceldatas')->where('id', $id)->first();
		
		return view('showresultsingle', compact('record'));
	  }

	
	public function editResult(Request $request, $id)
	{

		$record =exceldata::find($id);
		$record->name = $request->input('name');
		$record->email = $request->input('email');
		$record->phone = $request->input('phone');
		$record->message = $request->input('message');
	
		if($record->save()){
			return redirect()->back()->with('success','Record successfully updated.');
		}
		else{
			return redirect()->back()->with('error',' Record is not updated .');
		}
		//return view('editrecordfrom');
		//return redirect()->back()->with('success', 'edit Result link clicked, underconstuction edit link');
	}

    //delete the record
	public function deleteResult($id)
	{
		$record = exceldata::find($id);
		if($record){
			
			if($record->delete()){
			
				return redirect()->back()->with('success', 'Record Removed');
			
			}
			else{
				
				return redirect()->back()->with('error', 'Record is not Removed');
			}
		}
		else{
			return redirect()->back()->with('error', 'NO Record Found');
		}
			
	}
	 //delete the record form single one
	 public function deleteResultOne($id)
	 {
		 $record = exceldata::find($id);
		 if($record){
			 
			 if($record->delete()){
			 
				 return view('feedback')->with('success', 'Record Removed');
			 }
			 else{
				 
				 return view('feedback')->with('error', 'Record is not Removed');
			 }
		 }
		 else{
			 return view('feedback')->with('error', 'NO Record Found');
		 }
			 
	 }
    
   // Download Files
	public function downloadExcel($type)
	{
		$data = exceldata::get()->toArray();
		
		return Excel::create('Event_Data', function($exceldated) use ($data) {
		$exceldated->sheet('mySheet', function($sheet) use ($data)
	    {
			 $sheet->fromArray($data);
			// var_dump($sheet->fromArray($data));
			// exit();
	         });
		})->download($type);
	}
	 // Download Files on spacific query 
	 public function downloadExcelSpecific($type)
	 {

		$fname = session('first_name');
		// session(['mobile_number'=>$mobile_number,'event_data'=>$event_date,'country'=>$country,'position'=>$position,'event_name'=>$event_name,'event_id'=>$event_id,'compnay'=>$compnay,'nature_of_business'=>$nature_of_business,'first_name'=>$first_name,'sur_name'=>$sur_name,'email_work'=>$email_work]);
		
		 
		$first_name = session('first_name');
        $sur_name = session('sur_name');
        $email_work = session('email_work');
        $country = session('country');
        $position = session('position');
        $event_id =session('event_id');
        $event_name = session('event_name');
        $nature_of_business = session('nature_of_business');
        $mobile_number = session('mobile_number');
		$event_date = session('event_date');
		$company = session('company');
		
		$record = DB::table('exceldatas');
		// $record = exceldata::get();

		 if ($first_name != NULL){
			$record->where('first_name', $first_name);
		}

		if ($sur_name != NULL){
			$record->where('sur_name', $sur_name);
		}

		if ($email_work != NULL){
			$record->where('email_work', $email_work);
		}

		if ($country != NULL){
			$record->where('country', $country);
		}
		
		if ($position != NULL){
			$record->where('position', $position);
		}
		
		if ($event_id != NULL){
			$record->where('event_id', $event_id);
		}
		
		if ($event_name != NULL){
			$record->where('event_name', $event_name);
		}
		
		if ($nature_of_business != NULL){
			$record->where('nature_of_business', $nature_of_business);
		}

		if ($nature_of_business != NULL){
			$record->where('nature_of_business', $nature_of_business);
		}
		if ($mobile_number != NULL){
			$record->where('mobile_number', $mobile_number);
		}
		if ($event_date != NULL){
			$record->where('event_date', $event_date);
		}

		if ($company != NULL){
			$record->where('company', $company);
		}

		$data1 = $record->get();
		//  $data1 =$record->get();
		  $dataen = $data1->toArray();
		  $data = json_decode(json_encode($dataen),true);
		// $data =  (explode(",",$datass));
		//  var_dump($data);
		//  exit();
		
		
			
		//  $data = exceldata::get()->toArray();
		 return Excel::create('Event_Data', function($exceldated) use ($data) {
		 $exceldated->sheet('mySheet', function($sheet) use ($data)
		 {
			$sheet->fromArray($data);
			// var_dump($sheet->fromArray($data));
			// exit();
			  });
		 })->download($type);
	 }


		// Download Files on spacific query 
		public function downloadSingle($id)
		{
			$type = 'csv';
			$data = exceldata::find($id)->toArray();
			return Excel::create('Single_Record', function($exceldated) use ($data) {
			$exceldated->sheet('mySheet', function($sheet) use ($data)
			{
				$sheet->fromArray($data);
				});
			})->download($type);
		}
	// import the CSV file into database 


	public function importExcel()
	{
		if(Input::hasFile('import_file')){
		$extension = Input::file('import_file')->getClientOriginalExtension();
		if($extension != "csv" )
		{
			return redirect()->back()->with('error','Please Make Sure the File Extension Should be CSV.');
		}
		else{
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [

					'name'=>$value->name,
					'email'=>$value->email,
					'phone'=>$value->phone,
					'message'=>$value->message,
					
					
				];
				}
				if(!empty($insert)){
					DB::table('exceldatas')->insert($insert);
				    return redirect()->back()->with('success','Insert Record successfully.');
				}
			}
		}
		}
		return back();
	}

	// import Record importRecord
	public function importRecord(Request $request)
	{
		
		
		$record = new exceldata;
		$record->name = $request->input('name');
		$record->email = $request->input('email');
		$record->phone = $request->input('phone');
		$record->message = $request->input('message');
		
		if($record->save()){
			return redirect()->back()->with('success','Insert Record successfully.');
		}
		else{
			return redirect()->back()->with('error',' Record is not Insert .');
		}
		
       
	}



//END Excel Controller function 
}


