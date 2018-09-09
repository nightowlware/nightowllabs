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
                        v-on:click="checklistSelected(checklist.id)"
                        v-long-press="() => {onChecklistHold(checklist.id)}"
                    >

                        {{checklist.name}}

                    </a>
                    <a id="checklist-adder" class="adder btn btn-lg list-group-item" @click="adderClicked">
                        <i class="fas fa-plus"></i>
                        <input id="adder-checklist-input"
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
                setTimeout(() => {$('#adder-checklist-input').focus();});
                this.isChecklistInputEnabled = true;
            },

            submitNewChecklist() {
                if (this.isChecklistInputEnabled) {
                    // truncate at max string length for DB: 191
                    const name = this.checklistNameInput.substring(0, 191);
                    if (name !== "") {
                        axios.post('api/checklists', {name}).then((res) => {
                            this.fetchChecklists();
                            this.checklistNameInput = '';
                        }).catch((err) => {console.warn(err)});
                    }
                    this.isChecklistInputEnabled = false;
                }
            },

            onChecklistHold(id) {
                // // TODO: improve this!
                const name = prompt('Enter a new name').substring(0, 191);
                if (name !== '') {
                    axios.put('api/checklists/'+id, {name}).then((res) => {
                        this.fetchChecklists();
                    }).catch((err) => {console.warn(err)});
                }
            }
        },

        computed: {
        },

        data() {
            return {
                checklists: null,
                currentChecklistId: null,
                checklistNameInput: '',
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
