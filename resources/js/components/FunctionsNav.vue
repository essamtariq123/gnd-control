<template>
 <div>  
    <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-success mr-3 my-2 my-sm-0" @click.prevent="openModal('Go')">Go All</button>
        <button class="btn btn-warning mr-3 my-2 my-sm-0" @click.prevent="openModal('Slow')">Slow All</button>
        <button class="btn btn-danger mr-3 my-2 my-sm-0" @click.prevent="openModal('Stop')">Stop All</button>
        <button class="btn btn-danger mr-3 my-2 my-sm-0" @click.prevent="openModal('Pause')">Pause</button>

    </form>

    <div class="modal" id="navModal" tabindex="-1" role="dialog">
        <div class="modal-dialog"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">ARE YOU SURE</h3>
                    <h6 class="modal-title">Are you sure you want to {{ modalType }} all locations</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" @click.prevent="sendAllSignal()" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

     <div class="modal" id="navPauseModal" tabindex="-1" role="dialog">
        <div class="modal-dialog"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">ARE YOU SURE</h3>
                    <h6 class="modal-title">Are you sure you want to {{ modalType }} all locations</h6>
                </div>
                 <div class="modal-body">
                        <div class="input-group">
                            <textarea class="form-control" v-model="pauseMessage" aria-label="Pause Message"></textarea>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" @click.prevent="sendAllSignal()" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
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
                modalType: null,
                pauseMessage: null
            }
        },
        mounted() {
        },

        methods: {

            openModal: function(type)
            {
                this.modalType = type

                if(type == 'Pause')
                {
                    $('#navPauseModal').modal('show');
                }
                else {
                    $('#navModal').modal('show');
                }

                
            },
            
            sendAllSignal: function(type, slave)
            {
                 let that = this

                 axios.post('/send/all/signal', {
                    signal: that.modalType,
                    pause: that.pauseMessage
                })
                .then(function (response) {
                    $('#navModal').modal('hide');
                    $('#navPauseModal').modal('hide');
                    that.pauseMessage = null

                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
