<section class="announcementBar d-flex align-items-center">
    <i class="bx bx-broadcast flex-fill mx-2"></i>
    <?php if( isset($_SESSION['logged_in']) ): ?>
        <div class="marquee flex-fill" id="annlist"></div>
    <?php else: ?>
        <div class="marquee flex-fill">
            <!-- <a class="mx-5" href="javascript:void(0);">Enjoy gaming with <?=$_ENV['company'];?> even more! Asia's Most Trusted Platform. Play Safe, Play me!</a> -->
            <a class="mx-5" href="javascript:void(0);"><?=lang('Label.anncword',[$_ENV['company']]);?></a>
        </div>
    <?php endif; ?>
</section>