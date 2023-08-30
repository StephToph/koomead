<?php

namespace App\Controllers;

class Cron extends BaseController {
    public function index() {}

    //// Subscription notification
    public function subs() {
      // $users = $this->Crud->read_single('role_id', 1, 'user');
      $users = $this->Crud->read('user');
      if(!empty($users)) {
        foreach($users as $u) {
          // check expiry date
          $end_date = $u->end_date;
          $days = $this->Crud->date_diff(date('Y-m-d'), $end_date);
          if($days > 7) continue;
          
          $fullname = $u->fullname;
          $sub = $this->Crud->read_field('id', $u->sub_id, 'subscription', 'name');
          $id = $u->id;
          $email = $u->email;

          if(!empty($email)) {
            $body = '';
            
            if($days > 0 && $days <= 7) {
              if($days > 1) {
                $days = $days.' days';
              } else {
                $days = $days.' day';
              } 
              $subject = 'Subscription Expiring';
              $body = 'Your subscription for '.$sub.' is expiring in '.$days.' ('.date('M d, Y', strtotime($end_date)).'). Please renew your subscription to continue enjoying our services.';
            } else if($days <= 0) {
              $subject = 'Subscription Expired';
              $body = 'Your subscription for '.$sub.' has expired on '.date('M d, Y', strtotime($end_date)).'. Please renew your subscription to continue enjoying our services.';
            }

            $this->Crud->activity('subscription', $id, $body);
            
            if(!empty($body)) {
                // send email
                $em['from'] = 'PCDL4Kids <'.app_email.'>';
                $em['to'] = $fullname.' <'.$email.'>';
                $em['subject'] = $subject;
                $em['template'] = 'general';
                $em['t:variables'] = '{"name": "'.$fullname.'", "body": "'.$body.'"}';
                // $sendEmail = $this->Crud->mailgun($em);
            }
          }
        }
      }
    }
}
