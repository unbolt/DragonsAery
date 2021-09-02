<template>
    <div class="relative pt-1 w-full">
        <div class="flex mb-2 items-center justify-between">
            <div>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-pink-600 bg-pink-200">
                {{ mission.mission.category.name}} / {{ mission.mission.name }} [{{mission.success_chance }}% success chance]
            </span>
            </div>
            <div class="text-right">
            <span class="text-xs font-semibold inline-block text-pink-600">
                {{ mission.progress_percent }}%
            </span>
            </div>
        </div>
        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-pink-200">
            <div :style="'width: ' + mission.progress_percent + '%;'" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500"></div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['mission'],
}

</script>