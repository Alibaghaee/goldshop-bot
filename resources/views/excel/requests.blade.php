<table>
    <thead>
        <tr>
            <th style="text-align: center; background-color: #dae1e7; width: 10px; height: 55px; vertical-align: center;"><strong>@lang('id')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Department')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Room')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Bed')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Request Service')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Service Options')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Date Send')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Time Request Send')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Deleted')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Request Status')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Request Category')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Shared')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Shared-Time')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('User-Shared')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Accepted-Time')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('User-Accepted')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('Done-Time')</strong></th>
            <th style="text-align: center; background-color: #dae1e7; width: 18px; height: 55px; vertical-align: center;"><strong>@lang('User-Done')</strong></th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ $request->id }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ $request->department_title }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ $request->room_title }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ $request->entity_title }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ optional(optional($request->items)->first())->item_title ?? '---' }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ optional(optional($request->items)->first())->options_string ?? '---' }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ $request->created_at->format('Y-m-d') }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ $request->created_at->format('H:i:s') }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ optional($request->items)->count() ? __('No') : __('Yes') }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ optional(optional($request->items)->first())->status_title ?? '---' }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ optional(optional(optional($request->items)->first())->item)->parent_title ?? '---' }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">{{ optional(optional($request->items)->first())->shared_by ? __('Yes') : __('No') }}</td>
            <td style="height: 55px; vertical-align: center; text-align: center;">
                @if($action = optional(optional(optional(optional($request->items)->first())->acceptances)->where('status', 4))->last())
                {{ $action->created_at->format('H:i:s') }}
                @endif
            </td>
            <td style="height: 55px; vertical-align: center; text-align: center;">
                @if($action = optional(optional(optional(optional($request->items)->first())->acceptances)->where('status', 4))->last())
                {{ optional($action->admin)->fullname  }}
                @endif
            </td>
            <td style="height: 55px; vertical-align: center; text-align: center;">
                @if($action = optional(optional(optional(optional($request->items)->first())->acceptances)->where('status', 1))->last())
                {{ $action->created_at->format('H:i:s') }}
                @endif
            </td>
            <td style="height: 55px; vertical-align: center; text-align: center;">
                @if($action = optional(optional(optional(optional($request->items)->first())->acceptances)->where('status', 1))->last())
                {{ optional($action->admin)->fullname  }}
                @endif
            </td>
            <td style="height: 55px; vertical-align: center; text-align: center;">
                @if($action = optional(optional(optional(optional($request->items)->first())->acceptances)->where('status', 2))->last())
                {{ $action->created_at->format('H:i:s') }}
                @endif
            </td>
            <td style="height: 55px; vertical-align: center; text-align: center;">
                @if($action = optional(optional(optional(optional($request->items)->first())->acceptances)->where('status', 2))->last())
                {{ optional($action->admin)->fullname  }}
                @endif
            </td>
            
            
            
        </tr>

        
    @endforeach

    </tbody>
</table>