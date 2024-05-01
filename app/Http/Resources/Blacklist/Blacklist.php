<?php

namespace App\Http\Resources\Blacklist;

use Illuminate\Http\Resources\Json\JsonResource;

class Blacklist extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                           => $this->id,
            'message'                      => $this->message,
            'message_part'                 => $this->message_part,
            'status'                       => $this->status,
            'user_fullname'                => optional($this->user)->fullname,
            'user_mobile'                  => optional($this->user)->mobile,
            'user_email'                   => optional($this->user)->email,
            'admin_fullname'               => optional($this->admin)->fullname,
            'admin_domain'                 => optional($this->admin)->domain,
            'date'                         => $this->date_fa,
            'blacklist_type'               => $this->blacklist_type,
            'sendable_count'               => $this->sendable_count,
            'sended_count'                 => $this->sended_count,
            'user_cash'                    => optional($this->user)->cash,
            'needed_cash'                  => $this->needed_cash,
            'deliver_status'               => $this->deliver_status,
            'sender_number'                => $this->sender_number,
            'messages_count'               => $this->messages_count,
            'messages_blacklist_count'     => $this->messages_blacklist_count,
            'lack_of_cash'                 => $this->lack_of_cash,
            'sended_blacklists_export_url' => $this->sended_blacklists_export_url,
            'send_type'                    => $this->send_type,
            'staff_fullname'               => optional($this->staff)->fullname,
            'export_files_list'            => $this->exportFilesList(),
            'sms_group'                    => $this->sms_group,
            'user_id'                      => $this->user_id,
            'admin_id'                     => $this->admin_id,
            'table_name'                   => $this->table_name,
            'send_type'                    => $this->send_type,
            'staff_id'                     => $this->staff_id,
            'irancell_blacklists_count'    => $this->irancell_blacklists_count,
            'blacklist_price_for_user'     => user_blacklist_price($this),
            'blacklist_price_for_admin'    => admin_blacklist_price($this),
            'user_link'                    => $this->user_link,
            'sended_sms_count_cache'       => $this->sended_sms_count_cache,
            // 'edit_uri'                 => $this->edit_uri,
            // 'delete_uri'               => $this->delete_uri,
        ];
    }
}
