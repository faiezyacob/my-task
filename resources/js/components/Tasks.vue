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
                                {{ task.title }}  
                            </div>
                            <div class="card-body">
                                {{ task.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                tasks: [],
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


        },

        mounted() {
           this.getTasks();
        },
    }

</script>