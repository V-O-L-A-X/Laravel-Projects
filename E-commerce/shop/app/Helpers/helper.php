<?php
use App\Models\category;
use App\Models\productimage;
use App\Models\order; 
use App\Models\country; 
use App\Models\page; 
use App\Mail\OrderEmail;
use Illuminate\Support\Facades\Mail;


function getCategories()

{
   return Category::orderBy('id','DESC')
   ->with('subcat')
   ->orderBy('id','DESC')
   ->where('status',1)
   ->where('showHome','Yes')
   ->get();
    
}

function getProductImage($productId)
{
   return productimage::where('product_id',$productId)->first();
}

function orderEmail($orderId, $userType="customer")
{
   $order = order::where('id',$orderId)->with('items')->first();

   if($userType == 'customer')
   {
      $subject = 'Thanks for your order';
      $email = $order->email;
   }
   else
   {
      $subject = 'You have received and order';
      $email = env('ADMIN_EMAIL');
   }


   $mailData = [
      'subject' => $subject,
      'order' => $order,
      'userType' => $userType
   ];
   Mail::to($email)->send(new OrderEmail($mailData));
}

function getCountryInfo($id)
{
   return country::where('id',$id)->first();
}

function staticPages()
{
   $page = page::orderBy('name','ASC')->get();
   return $page; 
}
?>