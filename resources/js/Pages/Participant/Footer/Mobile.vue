<template>
    <footer class="footer p-2" >
        <ul class="nav nav-pills nav-justified card-footer-tabs">
            <li class="nav-item">
                <Link href="/participant" class="nav-link">
                    <i class="fs-20 ri-home-3-fill"></i>
                </Link>
            </li>
            <li class="nav-item">
                <Link href="/exhibits" class="nav-link">
                    <i class="fs-20 ri-file-text-fill"></i>
                </Link>
            </li>
            <li class="nav-item">
                <Link href="/qrcode" class="nav-link">
                    <button class="btn btn-primary btn-md position-relative p-0 avatar-md rounded-circle" style="margin-top: -55px;" type="button">
                        <div class="btn-content">
                            <span class="avatar-title bg-transparent text-reset">
                                <i class='fs-24 ri-qr-code-line'></i>
                            </span>
                        </div>
                    </button>
                </Link>
            </li>
            <li class="nav-item">
                <Link href="/schedules" class="nav-link">
                    <i class="fs-20 ri-calendar-fill"></i>
                </Link>
            </li>
            <li class="nav-item">
                <Link href="/settings" class="nav-link">
                    <i class='fs-20 ri-settings-4-fill'></i>
                </Link>
            </li>
        </ul>
    </footer>
</template>
<script>
export default {
    
}
</script>
<style>
    .footer {
        left: 0;
        position: fixed;
        border-top: .1rem solid;
        border-color: #e4e2e2;
    }
</style>