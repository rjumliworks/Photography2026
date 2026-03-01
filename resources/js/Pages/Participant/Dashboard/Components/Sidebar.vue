<template>
    <div class="card shadow-none border">
        <div class="card-header bg-light-subtle">
            <div class="d-flex mb-n3">
                <div class="flex-shrink-0 me-3">
                    <div style="height:2.5rem;width:2.5rem;">
                        <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                          
                        </span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <h5 class="mb-0 fs-14">s</h5>
                    <p class="text-muted text-truncate-two-lines fs-12">
                        <span v-if="timeLeft.total > 0">
                           asda remaining
                        </span>
                        <span v-else>
                            Expired
                        </span>
                    </p>
                </div>
                <div class="flex-shrink-0"></div>
            </div>
        </div>
        <div class="card-body border-bottom bg-white">
            <p class="mb-0 text-primary fs-12 fw-semibold">Storage Status : </p>
        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            timeLeft: {
                total: 0,
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0
            },
            timer: null
        }
    },
   
    methods: {
        updateCountdown() {
            const now = new Date().getTime()
            const endTime = new Date(this.plan.data.end).getTime() // 👈 use plan.end here
            const diff = endTime - now

            if (diff <= 0) {
                this.timeLeft = { total: 0, days: 0, hours: 0, minutes: 0, seconds: 0 }
                clearInterval(this.timer)
                return
            }

            this.timeLeft = {
                total: diff,
                days: Math.floor(diff / (1000 * 60 * 60 * 24)),
                hours: Math.floor((diff / (1000 * 60 * 60)) % 24),
                minutes: Math.floor((diff / (1000 * 60)) % 60),
                seconds: Math.floor((diff / 1000) % 60)
            }
        }
    }
}
</script>
