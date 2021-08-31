<template>
    <div class="flex flex-row">
        <div>
            <img :src="'/img/icon/' + item.int_id + '.png'" :alt="item.en_name" class="mr-2" width="26" />
        </div>
        <div>
            <div class="mb-2">
                <strong class="mr-2 float-left">{{ item.en_name }}</strong>
                <div v-if="item.rare == 1" class="rounded-lg bg-yellow-200 w-6 text-center float-left">r</div>
                <div v-if="item.ex == 1" class="rounded-lg bg-green-200 w-6 text-center float-left">e</div>
            </div>
            <div class="clear-both py-2" v-html="item.en_description"></div>
            <div>
                <span v-if="item.level > 0" class="pr-2">
                    Lv. {{ item.level }}
                </span>
                <span v-if="item.jobs" class="item_dispay_jobs">
                    <span v-for="job in item.jobs" v-bind:key='job'>
                        {{ job }}
                    </span>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['item']
}
</script>

<style scoped>
.item_dispay_jobs span:not(:last-child)::after {
    content: ' / ';
}
</style>
