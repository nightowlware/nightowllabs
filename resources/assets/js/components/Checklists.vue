<template>
    <div class="row">
        <div class="col-md-9">
            <div class="flexy-start">
                <div id="ribbon" class="list-group">
                    Select Checklist:
                    <a
                        class="btn btn-lg list-group-item"
                        v-for="checklist in checklists"
                        v-bind:class="{selected: checklist.id===currentChecklistId}"
                        v-bind:id="'checklist_'+checklist.id"
                        v-on:click="checklistSelected(checklist.id)">

                        {{checklist.name}}

                    </a>
                </div>

                <checklist class="pl-4" v-bind:id="currentChecklistId">
                </checklist>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            'checklist': require('./Checklist.vue')
        },

        mounted() {
            this.fetchChecklists();
        },

        methods: {
            fetchChecklists() {
                axios.get('api/checklists').then((res) => {
                    this.checklists = res.data;
                    // console.info(this.checklists);
                }).catch((err) => {console.warn(err)});
            },

            checklistSelected(id) {
                this.currentChecklistId = id;
                // console.log('Selected checklist: ' + id);
            }
        },

        computed: {
        },

        data() {
            return {
                checklists: null,
                currentChecklistId: null,
            };
        },

        watch: {
        }
    }
</script>

<style>
    #ribbon {
        flex-direction: column;
    }

    .selected {
        color: var(--warning) !important;
    }

    .red {
        color: red;
    }

    .hugefont {
        margin-left: auto;
        margin-right: auto;
        font-size: 4rem;
    }
</style>
