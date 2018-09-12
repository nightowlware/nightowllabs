<template>
    <div class="row">
        <div class="col-md-9">
            <div class="flexy-start">
                <div id="checklist-ribbon" class="ribbon list-group">
                    Checklist:
                    <div
                        class="show position-relative"
                        v-for="checklist in checklists"
                    >
                        <a
                            class="flexy-center btn btn-lg list-group-item"
                            v-on:click="checklistSelected({id: checklist.id, name: checklist.name}, $event)"
                            :class="[{selected: isSelected(checklist.id)}]"
                            :id="'checklist_'+checklist.id"
                        >
                            <span class="elide">
                                {{checklist.name}}
                            </span>

                            <span
                                    class="px-1 inline-block selected h5"
                                    v-if="isSelected(checklist.id)"
                                    :class="{'dropdown-toggle': isSelected(checklist.id)}"
                                    :data-toggle="isSelected(checklist.id) ? 'dropdown' : false"
                                    :aria-haspopup="isSelected(checklist.id) ? 'true' : 'false'"
                                    :aria-expanded="isSelected(checklist.id) ? 'false' : false"
                            >
                            </span>


                            <!--Popup menu-->
                            <div :id="'checklist-popup-'+checklist.id" class="position-absolute selected dropdown-menu" :aria-labelledby="'checklist_'+checklist.id">
                                <a class="dropdown-item" @click="editClicked(checklist.id)">Edit Name</a>
                                <a class="dropdown-item" @click="deleteClicked(checklist.id)">Delete Checklist!</a>
                            </div>
                        </a>
                    </div>

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

                <checklist class="pl-4" :id="currentChecklistId" ref="childChecklist">
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

                // update the child's state
                this.$refs.childChecklist.fetchItems();
            },

            checklistSelected({id, name}, event) {
                this.currentChecklistId = id;
            },

            adderClicked(event) {
                this.isChecklistInputEnabled = true;
                setTimeout(() => {$('#adder-checklist-input').focus();});
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

            isSelected(id) {
                return id === this.currentChecklistId;
            },

            editClicked(id) {
                // // TODO: improve this!
                const name = prompt('Enter a new name').substring(0, 191);
                if (name !== '') {
                    axios.put('api/checklists/'+id, {name}).then((res) => {
                        this.fetchChecklists();
                    }).catch((err) => {console.warn(err)});
                }
            },

            deleteClicked(id) {
                axios.delete('api/checklists/'+id).then((res) => {
                    this.currentChecklistId = null;
                    this.fetchChecklists();
                }).catch((err) => {console.warn(err)});
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
    .ribbon {
        flex-direction: column;
        min-width: 20%;
    }

    .elide {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
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

    .dropdown-menu {
        border: 1px dimgray solid;
    }

    .dropdown-toggle::after {
        vertical-align: 0.04rem;
    }
</style>
