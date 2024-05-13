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
     class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
    <h3 class="text-white font-semibold text-xl">Registration percentage</h3>
    <p class="text-white mb-3" x-show="currentVal == 0">To ensure the best possible experience, please complete your registration.</p>
    <p class="text-white mb-3" x-show="currentVal > 0">In progress: <span x-text="currentVal + '%'"></span></p>
    <div class="progress"
         :aria-valuenow="currentVal" :aria-valuemin="minVal" :aria-valuemax="maxVal">
        <div class="line" :style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%; transition: 1s;`"></div>
    </div>
</div>
