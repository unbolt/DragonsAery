<template>
    <div class="relative pt-1 w-full">
        <div class="flex mb-2 items-center justify-between">
            <div>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-pink-200">
                    {{ mission.mission.category.name}} / {{ mission.mission.name }}
                </span>
            </div>
            <div class="text-right text-xs font-semibold inline-block">
                <span v-if="mission.success == 0"  class="text-red-600">
                    Failed
                </span>
                <span v-if="mission.success == 1" class="text-green-600">
                    Success
                </span>
                💠 {{ mission.mission.dkp }}
            </div>
        </div>
        <div v-if="mission.success == 1" class="text-sm">
            <div v-if="mission.rewards.length">
                <span v-for="reward in mission.rewards" v-bind:key='reward.id'>
                    {{ reward.item.en_name }} x{{reward.quantity}}
                </span>
            </div>
            <div v-else>
                No loot :(
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['mission'],
}

</script>