<template>
    <div class="row">
        <div class="col-md-9">
            <div class="flexy-start">
                <div id="ribbon" class="list-group">
                    Checklist:
                    <a
                        class="btn btn-lg list-group-item"
                        v-for="checklist in checklists"
                        v-bind:class="{selected: checklist.id===currentChecklistId}"
                        v-bind:id="'checklist_'+checklist.id"
                        v-on:click="checklistSelected(checklist.id)">

                        {{checklist.name}}

                    </a>
                    <a id="checklist-adder" class="adder btn btn-lg list-group-item" @click="adderClicked">
                        <i class="fas fa-plus"></i>
                        <input id="adder-input"
                               @keyup.enter="submitNewChecklist"
                               @blur="submitNewChecklist"
                               v-if="isChecklistInputEnabled"
                               class="form-control"
                               v-model="checklistNameInput"
                               placeholder="Type Checklist Name">
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
            },

            adderClicked(event) {
                setTimeout(() => {$('#adder-input').focus();});
                this.isChecklistInputEnabled = true;
            },

            submitNewChecklist() {
                if (this.isChecklistInputEnabled) {
                    const name = $('#adder-input').val();
                    if (name && name !== "") {
                        axios.post('api/checklists', {name}).then((res) => {
                            this.fetchChecklists();
                            $('#adder-input').val('');
                        }).catch((err) => {console.warn(err)});
                    }
                    this.isChecklistInputEnabled = false;
                }
            }
        },

        computed: {
        },

        data() {
            return {
                checklists: null,
                currentChecklistId: null,
                checklistNameInput: null,
                isChecklistInputEnabled: false
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

    .adder {
        margin-top: 4px;
        background: black;
        border: 2px solid;
    }
</style>
