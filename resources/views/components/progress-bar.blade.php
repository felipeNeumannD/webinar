

<div class="progress" style="height: 20px;">
    <div class="{{$color}} " 
         role="progressbar" 
         style="width: {{ $percentage }}%; transition: width 0.3s;" 
         aria-valuenow="{{ $percentage }}" 
         aria-valuemin="0" 
         aria-valuemax="100">
         {{ $percentage }}%
    </div>
</div>