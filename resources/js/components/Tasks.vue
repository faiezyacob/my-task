<template> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <h1 style="padding-left:15px">Tasks</h1>
                </div>  
                <div class="row">
                    <div class="col-md-4 mt-4 h-100">
                        <div class="card d-flex pointer">
                            <div class="card-body align-items-center d-flex justify-content-center">
                                <p class="add-button"><a href="/tasks/form">+</a></p>
                            </div>
                        </div>
                    </div>
                    <div v-for="task in tasks" class="col-md-4 mt-4">
                        <div class="card pointer h-100">
                            <div class="card-header card-green">
                                {{ task.title.toUpperCase() }} 
                            </div>
                            <div class="card-body">
                                <p class="grey">{{ task.created_at | fulldate}}</p>
                                <span class="badge badge-primary">{{ task.temp }}</span>
                                <p>{{ task.description }}</p>
                                <p class="due">Due: {{ task.due | fulldate}}</p>
                                
                            </div>
                            <div class="card-footer">
                                <button @click="deleteTask(task)"  class="btn btn-danger btn-max">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    import moment from 'moment'

    export default {

        data() {
            return {
                tasks: [],
            }
        },

        filters: {
            fulldate:function(date) {
                return date = moment(date).format("D MMM, YYYY");
            },
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

            deleteTask:function(task){
                const confirmacion = confirm(`Do you really want to delete: ${task.title}?`);
                if(confirmacion){
                axios.delete(`/tasks/delete/${task.id}`)
                  .then(()=>{
                    // console.log('delete success');
                    location.href="/home";
                  })
                }
            },

            editForm:function(task) {
                location.href= `/tasks/edit/${task.id}`
            },


        },

        mounted() {
           this.getTasks();
        },
    }

</script>