    
    <?php
    if ($total_records > 0) { ?>

        <div class="row">

            <?php
            foreach ($newsletters as $y) { 

                $newsletter_download_path = base_url('assets/uploads/newsletters/'.$y->the_file); ?>

                <div class="col-12 m-b-30">
                    <article class="blog__single text__post blog__item">
                        <div class="blog__content">
                            <h2 class=""><img class="pdf-icon" src="<?php echo pdf_icon; ?>" />
                                <?php echo $y->title; ?>
                            </h2>
                            <ul class="bl__post">
                                <li>Posted on: 10th November, 2017</li>
                            </ul>
                            <div class="blog__btn">
                                <a class="dcare__btn btn__f6f6f6" href="<?php echo $newsletter_download_path; ?>" target="_blank"><i class="fa fa-download"></i> View/Download</a>
                            </div>
                        </div>
                    </article>
                </div>

            <?php } ?>

        </div>

        
    <?php } else { ?>

        <h3 class="text-danger">No newsletter to show.</h3>

    <?php } ?>


    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="dcare__pagination">
                <?php echo pagination_links($links, 'dcare__page__list d-flex'); ?>
            </div>
        </div>
    </div>



    