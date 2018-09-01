<html>
    <head>
        <title>Blood Donation FAQS - BloodGrant.ph</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        
        <style>
           

            .panel-heading a:focus {
                outline: none;
            }

            .panel-heading a,
            .panel-heading a:hover,
            .panel-heading a:focus {
                text-decoration: none;
                color: #777777;
            }


            .active-faq {
                border-left: 5px solid #888888;
            }

            .panel-faq .panel-heading .panel-title span {
                font-size: 13px;
                font-weight: normal;
            }
        </style>
    </head>
    <body>
        
        <nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>						
					<a class="navbar-brand" href="<?php echo base_url();?>">BloodGrant.ph</a>
				</div> <!-- navbar header -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>">Home<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?php echo base_url();?>UsersController/aboutview">About</a></li>
                        <li class="active"><a href="<?php echo base_url();?>FaqsController">FAQs</a></li>
                    </ul>
                    
					<ul class="nav navbar-nav navbar-right">
					
                        <li><a href="<?php echo base_url();?>UsersController/register">Register</a></li>
                        <li><a href="<?php echo base_url();?>UsersController/login">Login</a></li>
                    
					</ul>
				</div> <!-- end navbar-collapse -->
			</div><!-- end container-fluid -->
		</nav><!--end navbar -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1><strong>FAQs</strong></h1>
                    <hr class="colorgraph"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="active in fade">
                        <div class="panel-group">
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-1">
                                        <h4 class="panel-title">
                                            What happens to my donated blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Each unit of blood collected will be examined for 5 transfusion-transmissible infectious diseases, namely: HIV, Malaria, Syphillis, Hepatitis B, and Hepatitis C before it is transfused to patients.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/1st question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-2">
                                        <h4 class="panel-title">
                                            Is it safe to give blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Yes. The Red Cross ensures that donating blood is a safe opportunity to give the gift of life. Each needle used in the procedure is sterile and is disposed after a single use. It is important that all blood donors are in good health, well-rested, and have eaten prior to donation.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/2nd question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-3">
                                        <h4 class="panel-title">
                                            When can we donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        A healthy person may donate blood every three months.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/3rd question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-4">
                                        <h4 class="panel-title">
                                            Where can I donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        You may come and visit PRC's National Blood Center, Regional Blood Centers, or any of its Blood Services Facilities, nationwide.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/4th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-5">
                                        <h4 class="panel-title">
                                            Can a person who has a tattoo donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        As long as the tattooing procedure was done aseptically (in a sterile manner), he/ she may donate blood one year after the procedure. This is the same with ear piercing, acupuncture, and other procedures involving needles.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/5th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-6">
                                        <h4 class="panel-title">
                                            Are the health history questions necessary every time I donate?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-6" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        To ensure the safest possible blood supply, all donors must undergo the necessary screening every donation. The World Health Organization and the Department of Health require all blood centers to conform to this practice.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/6th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-7">
                                        <h4 class="panel-title">
                                            What does the term "donor deferral" mean?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-7" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Individuals disqualified from donating blood are known as "deferred" donors. A prospective donor may be deferred at any point during the collection and testing process. Whether or not a person is deferred, temporarily or permanently, will depend on the specific reason for disqualification (i.e. a person may be deferred temporarily because of anemia, a condition that is usually reversible). If a person is to be deferred, his or her name is entered into a list of deferred donors maintained by the blood center, often known as the "deferral registry." If a deferred donor attempts to give blood before the end of the deferral period, the donor will not be accepted for donation. Once the reason for the deferral no longer exists and the temporary deferral period has lapsed, the donor may return to the blood bank and be re-entered into the system.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/7th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-8">
                                        <h4 class="panel-title">
                                            If I was deferred once before, am I still ineligible to donate?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-8" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        If your deferral is of a permanent nature, you will be informed. Otherwise, the deferral time depends upon the reason for deferral. Prior to each donation, you will be given a mini-physical and medical interview. At that time, it will be determined if you are eligible to donate blood on that particular day.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/8th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-9">
                                        <h4 class="panel-title">
                                            What are some of the reasons for permanent deferral?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-9" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li><span class="glyphicon glyphicon-tint"></span> Hepatitis B or C infection.</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> HIV infection.</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> Having sexual contact with a person infected with HIV.</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> Having multiple sex partners/patronizing sex workers.</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> Serious chronic illness (i.e. heart and lung diseases).</li>
                                        </ul>
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/9th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-10">
                                        <h4 class="panel-title">
                                            Can a person who just had his/ her tooth extracted donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-10" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        The person will be temporarily deferred for a year.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/10th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-11">
                                        <h4 class="panel-title">
                                            If I just received a flu shot, can I donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-11" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Yes. There is no waiting period to donate after receiving a flu shot.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/11th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-12">
                                        <h4 class="panel-title">
                                            If I have a cold flu, can I donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-12" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        In order to donate, blood centers require that you should be generally in good health (symptom-free); thus, it is important that you are feeling well.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/12th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-13">
                                        <h4 class="panel-title">
                                            Can I still donate if I have high blood pressure?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-13" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Yes, if your blood pressure is under control and within the limits set in the donation guidelines.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/13th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-14">
                                        <h4 class="panel-title">
                                            What if I'm taking aspirin or medication prescribed by my doctor?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-14" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Aspirin and Ibuprofen will not affect a whole blood donation. Apheresis platelet donors, however, must not take aspirin or aspirin products 36 hours prior to the donation. Many other medications are acceptable; but it is recommended that you call the blood center ahead of time to inquire about the type of medication you are taking.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/14th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-15">
                                        <h4 class="panel-title">
                                            What if I have Anemia?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-15" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        You cannot give blood if you have anemia. However, this can often be a temporary condition. Your hemoglobin level will be tested before you donate, in order to make sure that it is within an acceptable range.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/15th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-16">
                                        <h4 class="panel-title">
                                            How long does it take to donate blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-16" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        The whole process of donating blood will only take an average of 25 minutes.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/16th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-17">
                                        <h4 class="panel-title">
                                            Will I put on weight after blood donation?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-17" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        No. All you put on is the feeling of satisfaction because you have helped someone.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/17th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-18">
                                        <h4 class="panel-title">
                                            What other types of tests are done on the blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-18" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Your blood is tested to determine your blood type—classified as A, B, AB, and O—and your Rh factor. The Rh factor refers to the presence or absence of a specific antigen, a substance capable of stimulating an immune response, in the blood; so, you are either Rh positive or Rh negative, meaning you either carry the antigen or you don't. This information is important to know, because your blood type and Rh factor must be compatible with the blood type and Rh factor of the person receiving your blood.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/18th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-19">
                                        <h4 class="panel-title">
                                            What is the most common blood type?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-19" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        The approximate distribution of blood types in the Philippines population is as follows (though distribution may be different forspecific racial and ethnic groups):
                                        <ul class="list-unstyled">
                                            <li><span class="glyphicon glyphicon-tint"></span> O Rh-positive <span class="glyphicon glyphicon-minus"></span> 44-46%</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> A Rh-positive <span class="glyphicon glyphicon-minus"></span> 22-23%</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> B Rh-positive <span class="glyphicon glyphicon-minus"></span> 24-25%</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> AB Rh-positive <span class="glyphicon glyphicon-minus"></span> 4-6%</li>
                                            <li><span class="glyphicon glyphicon-tint"></span> Rh-negative group <span class="glyphicon glyphicon-minus"></span> Less than 1%</li>
                                        </ul>
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/19th question -->                            
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-20">
                                        <h4 class="panel-title">
                                            What fees are associated with blood?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-20" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        While the donated blood is free, there are significant costs associated with the collection, testing, labeling, preparation of components, and storage of blood. In addition to these, charges are also incurred through recruitment and education of donors, as well as quality assurance. As a result, processing fees are charged to recover these costs. Blood processing fees collected are in conformance with the stipulated allowable fees as mandated by the Department of Health.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/20th question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-21">
                                        <h4 class="panel-title">
                                            What can you do if you aren't eligible to donate?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-21" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        While a given individual may be unable to donate, he or she may be able to recruit a suitable donor. PRC Blood Banks are always in need of volunteers to assist during blood donations, or to organize mobile blood drives. In addition, monetary donations through the Blood Samaritan Project of the Red Cross are always welcome, to help ensure that blood banks can continue providing safe blood to those in need, most especially to indigent patients.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/21st question -->
                            <div class="panel panel-info panel-faq">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" href="#faq-sub-22">
                                        <h4 class="panel-title">
                                            How can I host a mobile blood donation activity at work, school, church or community?
                                            <span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                        </h4>
                                    </a>
                                </div><!-- panel-heading/tanong -->
                                <div id="faq-sub-22" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Kindly refer to the PRC Blood Services Facility near you. Contact the blood center in order to learn more about the requirements.
                                    </div>
                                </div><!-- panel-collapse/sagot -->
                            </div><!-- end panel panel-default panel-faq/22nd question -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <hr class="colorgraph"/>
                </div>
            </div>
        </div>
        <div class="bg_load"></div>
        <div class="wrapper">
            <div class="inner text-danger">
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
                <span class="glyphicon glyphicon-tint"></span>
            </div>
        </div>
        
        <script>
            $(document).ready(function() {
                $('.collapse').on('show.bs.collapse', function() {
                    var id = $(this).attr('id');
                    $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
                    $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-chevron-up"></i>');
                });
                $('.collapse').on('hide.bs.collapse', function() {
                    var id = $(this).attr('id');
                    $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
                    $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-chevron-down"></i>');
                });
            });
        </script>
        <script src="<?php echo base_url();?>assets/js/loadpage.js"></script>