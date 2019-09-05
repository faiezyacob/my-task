<template> 
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row mt-2">
                    <h1 style="padding-left: 15px">Add Task</h1>
                </div>  
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-header card-green">
                                Add Task  
                            </div>
                            <div class="card-body">
                                <form method="post" action="/user/save_tasks" @submit.prevent="saveTasks">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" v-model="form.title" placeholder="Title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" v-model="form.description" placeholder="Description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="due">Due</label>
                                        <datepicker v-model="form.due" id="dob" input-class="form-control" placeholder="Due" input-readonly="false"></datepicker>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" @click="saveTasks" id="submitBtn" class="btn btn-vue form-control">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</template>

<script>
    
    import datepicker from 'vuejs-datepicker'

    export default {

        components:{
            datepicker,
        },

        data() {
            return {
                tasks: [],
                form: {
                    title: '', 
                    description: '',
                    due: '',
                },
            }
        },

        methods: {

            getTasks:function(){
                var self = this;
                axios.get('/tasks').then(function(response){
                    self.tasks = response.data;
                    console.log(response.data)
                    // $("body").addClass('loaded');
                });
            },

            saveTasks:function() {
                $(".fa").addClass('fa-refresh fa-spin');
                $("#submitBtn").attr('disabled',true);
                console.log(this.form);
            },
        },

        mounted() {
           this.getTasks();
        },
    }

</script>