<template>
    <div class="">
        <div class="flex flex-row gap-4">
            <div class="flex-grow">
                <div class="text-2xl pb-1">
                    Completed Missions
                </div>

                <div v-if="missions.length == 0">
                    <Loading  />
                </div>
                
                <div v-for="mission in missions" v-bind:key='mission.id'>
                    <MissionComplete :mission='mission' />
                </div>

                <div class="text-center">
                    <VPagination
                        v-model="page"
                        :pages="pages"
                        :range-size="1"
                        active-color="#DCEDFF"
                        @update:modelValue="loadMissions"
                    />
                </div>


            </div>
        </div> 
    </div>
</template>

<script>

import Loading from '@/Components/Loading.vue'
import MissionComplete from '@/Components/Mission/Complete.vue'
import VPagination from "@hennge/vue3-pagination";

export default {

    components: {
        Loading,
        VPagination,
        MissionComplete
    },

    props: ['character'],

    data () {
        return {
            missions: [],
            page: 1,
            pages: 1
        }
    },
    mounted() {
        this.loadMissions();
    },
    methods: {
        loadMissions () {
            this.fetchPage(this.page);
        },
        fetchPage(page) {
            this.missions = [];
            axios
                .get('/mission/complete?page=' + page)
                .then((response) => {
                    console.log(response);
                    this.missions = Object.values(response.data.data);
                    this.page = response.data.current_page;
                    this.pages = response.data.last_page;
                });     
        }
    }
}
</script>

<style>

.Pagination {
    display: flex;
    flex-flow: row;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    list-style-type: none; 
}

.PaginationControl {
  display: flex;
  align-items: center; }

.Control {
  position: relative;
  display: block;
  width: 18px;
  height: 18px;
  margin: 0 2px;
  fill: #BBBBBB; }
  .Control-active {
    fill: #333333;
    cursor: pointer;
    transition: fill 0.2s ease-in-out; }
    .Control-active:hover {
      fill: #000000;
      transition: fill 0.2s ease-in-out; }


.Page {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  margin: 0 2px;
  color: #666666;
  background-color: transparent;
  font-size: 14px;
  border-radius: 3px;
  box-sizing: border-box;
  border-color: transparent;
  cursor: pointer;
  outline: 0;
  user-select: none; 
}
.Page:hover {
    border: 1px solid #DEDEDE;
}
.Page-active {
    color: rgba(219, 39, 119, 1) !important;
    border: 1px solid rgba(219, 39, 119, 1) !important;
    background-color: rgba(251, 207, 232, 1) !important;
}

.DotsHolder {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  margin: 0 2px;
  box-sizing: border-box; }

.Dots {
  width: 8px;
  height: 4px;
  fill: #BBBBBB; }

</style>