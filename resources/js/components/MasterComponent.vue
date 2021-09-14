<template>
    <div class="card-deck mt-5">
        <div class="card" style="background-color: #D7DBDD"  v-for="(slave, index) in slaves" :key="slave.email">
            <div class="card-body text-center" >
                <h2 class="font-bold-weight">{{ slave.username }}</h2>
                <div>
                    <div class="row mb-3" :style="getStyle(index)" style="place-content: center;padding: 30px;"> current state</div>
                    <div class="row mb-4" style="place-content: center">
                        <button @click="sentSignal('go', index)" class="btn btn-success">Go</button>
                    </div>
                     <div class="row mb-4" style="place-content: center">
                        <button @click="sentSignal('slow', index)" class="btn btn-danger">Slow</button>
                    </div>
                     <div class="row mb-4" style="place-content: center">
                        <button @click="sentSignal('stop', index)" class="btn btn-danger">Stop</button>
                    </div>
                     <div class="row mb-4" style="place-content: center">
                        <button @click.prevent="openModal(index)" class="btn btn-warning">Pause</button>
                    </div>
                </div>
            </div>
        </div>
         <div class="modal" id="pauseModal" tabindex="-1" role="dialog">
        <div class="modal-dialog"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">ARE YOU SURE</h3>
                    <h6 class="modal-title">Are you sure you want to Pause</h6>
                </div>
                 <div class="modal-body">
                        <div class="input-group">
                            <textarea class="form-control" v-model="pauseMessage" aria-label="Pause Message"></textarea>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" @click="sentSignal('pause', slaveId)" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import {db} from '../db.js'

    export default {
         data() {
            return {
                slaves: [],
                slaveId: null,
                pauseMessage: null,
                styles: []
            }
        },
        created()
        {
            
        },

        mounted() {
            this.getSlaves()
        },

        methods: {

            getStyle: function(slave)
            {
                let color = null;

                this.styles.forEach((style, index) => {

                    if(style.id == slave)
                    {
                        color = 'backgroundColor:'+style.color;
                    }
                })

                return color
            },

            openModal: function(slave)
            {
                this.slaveId = slave
               $('#pauseModal').modal('show');  
            },

            slavesListener()
            {
                let array = this.slaves;

                for (var key of Object.keys(array))
                {
                    let that = this
                    const todosRef = db.ref('sentSignals/'+key)

                    todosRef.limitToLast(1).on('child_added', snapshot => {

                        let slaveKey = snapshot.val().slaveID
                        let color = snapshot.val().colorCode

                        that.styles.push({id:slaveKey,color:color})
                    })
                }
            },

            getSlaves: function ()
            {
                let that = this
                 axios.get('/slaves')
                    .then(function (response) {
                        // handle success
                        that.slaves = response.data.slaves
                        that.slavesListener()

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

            },

            sentSignal: function(type, slave)
            {
                 let that = this

                 axios.post('/send/signal', {
                    slave: slave,
                    pause: that.pauseMessage,
                    signal: type
                })
                .then(function (response) {
                    $('#pauseModal').modal('hide'); 
                    that.slaveId = null
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
