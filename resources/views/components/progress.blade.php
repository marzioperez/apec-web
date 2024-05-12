@aware(['progress'])
<div x-data="{
    currentVal: {{$progress}},
    minVal: 0,
    maxVal: 100,
    calcPercentage(min, max, val){
        return ((val-min)/(max-min))*100
    }
    }"
     x-on:update-progress.window="currentVal = $event.detail.value"
    class="progress"
     :aria-valuenow="currentVal" :aria-valuemin="minVal" :aria-valuemax="maxVal">
    <div class="line" :style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%; transition: 1s;`"></div>
</div>
