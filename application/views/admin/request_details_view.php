<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loadpage.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sidebar.css">
        <script src="<?php echo base_url();?>assets/js/jqv1.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/js/sidebar.js"></script>
    </head>
    <body>
        <style>
            .row{
                margin-top:40px;
                padding: 0 10px;
            }
            .clickable{
                cursor: pointer;   
            }
            .panel-heading span {
                margin-top: -15px;
                font-size: 15px;
            }

            td{
                width: 25%;
                text-align: left;
            }
        </style>
        <div id="wrapper">
            <div class="overlay"></div>
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="<?=base_url();?>AdminController/landing_page">
                           BloodGrant.ph
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>AdminController/landing_page">Home</a>
                    </li>
                    <li>
                        <a href="<?=base_url();?>AdminController/notifications">Notifications <span class="badge pull-right"><?=$_SESSION['notifications'];?></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Requests <span class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Manage Requests</li>
                            <li><a href="<?=base_url();?>AdminController/rejected_requests_view">View Rejected Requests</a></li>
                            <li><a href="<?=base_url();?>AdminController/pending_requests_view">View Pending Requests</a></li>
                            <li><a href="<?=base_url();?>AdminController/approved_requests_view">View Approved Requests</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Moderators <span class="caret pull-right"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Manage Moderators</li>
                            <li><a href="<?=base_url();?>AdminController/manage_moderator_view">View Moderators</a></li>
                            <li><a href="<?=base_url();?>AdminController/add_moderator_view">Add Moderator</a></li>
                        </ul>
                        
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Users <span class="caret pull-right"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">Manage Users</li>
                        <li><a href="<?=base_url();?>AdminController/users_list_view">View Confirmed Users</a></li>
                        <li><a href="#">View Registered Users</a></li>
                      </ul>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>AdminController/logout">Logout</a>
                    </li>
                </ul>
            </nav>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
                <?php 

                $requestTime=date("l / F d, Y / h:i:s A ", strtotime($request->request_time));

                ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <?php if($this->session->flashdata('success')): ?>
                            <?= $this->session->flashdata('limiter');?>
                            <?= $this->session->flashdata('message');?>
                            <?= $this->session->flashdata('delimiter');?>
                            <?php endif;?>

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Request Number <?=$request->request_id;?> Details</strong></h3>
                                </div>
                                <table class="table table-hover table-condensed ">
                                    <tr>
                                        <td><strong>Requested By</strong></td>
                                        <td><a href="#"><?= $user->users_firstname.' '.$user->users_lastname;?></a></td>
                                        <td><strong>Other Information</strong></td>
                                        <td><?= $request->request_otherInfo;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Time Requested</strong></td>
                                        <td><?= date("F j, Y H:i A (D)",strtotime($request->request_time));?></td>
                                        <td><strong>Recipient's Relative Name</strong></td>
                                        <td><?=$request->request_relativeFName.' '.$request->request_relativeLName;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Blood Type Needed</strong></td>
                                        <td><?=$request->request_neededBloodType;?></td>
                                        <td><strong>Relative's Contact Number</strong></td>
                                        <td>0<?=$request->request_relativeContact;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Blood Component Needed</strong></td>
                                        <td><?=$request->request_neededBloodComponent;?></td>
                                        <td><strong>Relative's Email Address</strong></td>
                                        <?php if(empty($request->request_relativeEmail)):?>
                                        <td>Not Given</td>
                                        <?php else: ?>
                                        <td><?=$request->request_relativeEmail?></td>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Recipient</strong></td>
                                        <td><?=$request->request_patientFName.' '.$request->request_patientLName;?></td>
                                        <td><strong>Is request approved?</strong></td>
                                        <td>
                                            <?php if($request->request_approved==1): ?>
                                            <?php if($request->request_approvalType==1): ?>
                                            <span class="glyphicon glyphicon-ok-circle text-success"></span> Approved for Blood Bank release
                                            <?php else: ?>
                                            <span class="glyphicon glyphicon-ok-circle text-success"></span> Approved for Posting
                                            <?php endif;?>
                                            <?php else: ?>
                                            <span class="glyphicon glyphicon-remove-circle text-danger"></span> Not Approved
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Recipient's Age</strong></td>
                                        <td><?= $request->request_patientAge;?></td>
                                        <?php if($request->request_approved==1): ?>
                                        <td><strong>Request Approved by</strong></td>
                                        <td><a href="#"><?=$request->request_approvedBy;?></a></td>
                                        <?php else: ?>
                                        <?php if(empty($request->request_approvedBy)):?>
                                        <td><strong>Request Approved By</strong></td>
                                        <td>N/A</td>
                                        <?php else:?>
                                        <td><strong>Request Disapproved By</strong></td>
                                        <td><a href="#"><?=$request->request_approvedBy?></a></td>
                                        <?php endif;?>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Recipient's Condition</strong></td>
                                        <td><?= $request->request_patientCondition;?></td>
                                        <?php if($request->request_approved==1): ?>
                                        <td><strong>Request Approval Time</strong></td>
                                        <td><?= date("F j, Y H:i A (D)",strtotime($request->request_approvalTime));?></td>
                                        <?php else: ?>
                                        <?php if(empty($request->request_approvedBy)): ?>
                                        <td><strong>Request Approval Time</strong></td>
                                        <td>N/A</td>
                                        <?php else: ?>
                                        <td><strong>Request Disapproval Time</strong></td>
                                        <td><?= date("F j, Y H:i A (D)",strtotime($request->request_approvalTime));?></td>
                                        <?php endif;?>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Recipient's Location</strong></td>
                                        <td><?= $request->request_patientExactLocation;?></td>
                                        <td><strong>Is Request Posted?</strong></td>
                                        <?php if($request->request_posted==1): ?>
                                        <td><span class="glyphicon glyphicon-ok-circle text-success"></span> Posted</td>
                                        <?php else: ?>
                                        <td><span class="glyphicon glyphicon-remove-circle text-danger"></span> Not Posted</td>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Hospital Area</strong></td>
                                        <td><?= $request->request_patientExactLocationArea;?></td>
                                        <?php if($request->request_posted==1): ?>
                                        <td><strong>Request Posted By</strong></td>
                                        <td><a href="#"><?=$request->request_postedBy;?></a></td>
                                        <?php else: ?>
                                        <?php if(empty($request->request_postedBy)): ?>
                                        <td><strong>Request Posted By</strong></td>
                                        <td>N/A</td>
                                        <?php else: ?>
                                        <td><strong>Request Post Removed By</strong></td>
                                        <td><a href="#"><?=$request->request_postedBy;?></a></td>
                                        <?php endif;?>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Required Unit/s of Blood</strong></td>
                                        <td><?= $request->request_numberUnits;?></td>
                                        <?php if($request->request_posted==1): ?>
                                        <td><strong>Request Posting Time</strong></td>
                                        <td><?= date("F j, Y H:i A (D)",strtotime($request->request_postingTime));?></td>
                                        <?php else:?>
                                        <?php if(empty($request->request_postedBy)): ?>                                        
                                        <td><strong>Request Posting Time</strong></td>
                                        <td>N/A</td>
                                        <?php else: ?>
                                        <td><strong>Request Remove Post Time</strong></td>
                                        <td><?= date("F j, Y H:i A (D)",strtotime($request->request_postingTime));?></td>
                                        <?php endif;?>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Date Needed</strong></td>
                                        <td><?= date("F d, Y (l)",strtotime($request->request_dateNeeded));?></td>
                                        <td><strong>Request Completed?</strong></td>
                                        <?php if($request->request_completed==1): ?>
                                        <td><span class="glyphicon glyphicon-ok text-success"></span> Completed</td>
                                        <?php else: ?>
                                        <td><span class="glyphicon glyphicon-remove text-danger"></span> Not Completed</td>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td><strong>Number of Interested Donors</strong></td>
                                        <td><?= $request->request_NumInterestedDonors;?></td>
                                        <td><strong>Interested Donors</strong></td>
                                        <td><?= $request->request_InterestedDonors;?></td>
                                    </tr>
                                    <?php if($request->request_rejected==1): ?>
                                    <tr>
                                        <td><strong>Is Request Rejected?</strong></td>
                                        <td>Yes</td>
                                        <td><strong>Rejection Details</strong></td>
                                        <td><?=$request->request_rejectionDetails;?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Request Rejected by?</strong></td>
                                        <td><a href="#"><?=$request->request_rejectedBy;?></a></td>
                                        <td><strong>Request Rejection Time</strong></td>
                                        <td><?=date("F d, Y H:i:s",strtotime($request->request_rejectionDate));?></td>
                                    </tr>
                                    <?php endif;?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="btn-group btn-group-justified">
                                                <?php if($request->request_approved==0): ?>
                                                <a class="btn btn-default" href="<?=base_url();?>AdminController/pending_requests_view"><span class="glyphicon glyphicon-share-alt"></span> Return to pending requests list</a>
                                                <?php if($request->request_rejected==null): ?>
                                                <div class="btn-group">
                                                    <a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-check"></span> Approve this request</a>
                                                    <ul class="dropdown-menu col-md-12">
                                                        <li><a data-toggle="modal" data-target="#ApproveBloodModal">Approve for Immediate blood bank release</a></li>
                                                        <li><a data-toggle="modal" data-target="#ApprovePostModal">Approve for Posting</a></li>
                                                    </ul>
                                                </div>
                                                <a class="btn btn-danger" data-toggle="modal" data-target="#RejectModal"><span class="glyphicon glyphicon-ban-circle"></span> Reject this request</a>
                                                <?php else: ?>
                                                <a class="btn btn-danger disabled" href="#"><span class="glyphicon glyphicon-ban-circle"></span> You have rejected this request</a>
                                                <?php endif;?>
                                                <?php else: ?>
                                                <a class="btn btn-default" href="<?=base_url();?>AdminController/approved_requests_view"><span class="glyphicon glyphicon-share-alt"></span> Return to approved requests list</a>
                                                <?php if($request->request_approvalType==1)://1 = immediate / 2 - for posting?>
                                                <a class="btn btn-warning" data-toggle="modal" data-target="#UndoApproveModal"><span class="glyphicon glyphicon-edit"></span> Undo Approval</a>
                                                <?php elseif($request->request_approvalType==2): ?>
                                                <?php if($request->request_posted==0): ?>
                                                <a class="btn btn-warning" data-toggle="modal" data-target="#UndoApproveModal"><span class="glyphicon glyphicon-edit"></span> Undo Approval</a>
                                                <a class="btn btn-primary" data-toggle="modal" data-target="#PostModal"><span class="glyphicon glyphicon-pencil"></span> Post</a>
                                                <?php else: ?>
                                                <a class="btn btn-primary" data-toggle="modal" data-target="#UndoPostModal"><span class="glyphicon glyphicon-erase"></span> Undo Post</a>
                                                <?php endif;?>
                                                <?php endif;?>
                                                <?php endif;?>
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /#page-content-wrapper -->
            </div>
            <!-- undo post modal -->
            <div class="modal fade" id="UndoPostModal" tabindex="-1" role="dialog" aria-labelledby="UndoPostModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="UndoPostModal">Undo Post Request</h3>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to undo this post? It will not be visible to users once you undo this post</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                            <a class="btn btn-primary" href="<?=base_url();?>AdminController/in_remove_post/<?=$request->request_id;?>">Undo Post</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post Modal -->
            <div class="modal fade" id="PostModal" tabindex="-1" role="dialog" aria-labelledby="PostModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="PostModal">Post Request</h3>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to post this request?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a class="btn btn-primary" href="<?=base_url();?>AdminController/in_post_request/<?=$request->request_id;?>">Post</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- undo approval modal-->
            <div class="modal fade" id="UndoApproveModal" tabindex="-1" role="dialog" aria-labelledby="PostModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="UndoApproveModal">Disapprove Request</h3>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to disapprove this request?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a class="btn btn-warning" href="<?=base_url();?>AdminController/in_disapprove_request_for_post/<?=$request->request_id;?>">Undo Approval</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- delete req modal -->
            <div class="modal fade" id="RejectModal" tabindex="-1" role="dialog" aria-labelledby="PostModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form role="form" name="reject-request" onsubmit="return validateForm()" action="<?=base_url();?>AdminController/reject_request" method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="DeleteModal">Reject Request</h3>
                            </div>
                            <div class="modal-body">

                                <div id="the-message"></div>
                                <div class="form-group" hidden="hidden">
                                    <input type="hidden" name="request_id" value="<?=$request->request_id;?>">
                                </div>
                                <div class="form-group">
                                    <label>Note that this process is irreversible</label></br>
                                    <label for="reject_reason">state your reason for rejecting this request</label>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" style="min-width:100%;" name="reject_reason" id="reject_reason"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Reject Request</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- approve for posting modal -->
            <div class="modal fade" id="ApprovePostModal" tabindex="-1" role="dialog" aria-labelledby="PostModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="ApprovePostModal">Approve Request for Posting</h3>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to approve this request for posting?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a class="btn btn-warning" href="<?=base_url();?>AdminController/in_approve_request_for_post/<?=$request->request_id;?>">Approve request for posting</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- approve for blood bank -->
            <div class="modal fade" id="ApproveBloodModal" tabindex="-1" role="dialog" aria-labelledby="PostModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="ApproveBloodModal">Approve Request for Immediate Blood Bank Release</h3>
                        </div>
                        <div class="modal-body">
                            <p>Do you want to approve this request for immediate blood bank release?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a class="btn btn-warning" href="<?=base_url();?>AdminController/in_approve_request_immediately/<?=$request->request_id.'/'.$request->request_by_id;?>">Approve request</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#wrapper -->
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
                function validateForm() {
                    var x = document.forms["reject-request"]["reject_reason"].value;
                    if (x == null || x == "") {
                        alert("You must indicate a reason for rejecting this request");
                        return false;
                    }
                }
            </script>
            <script src="<?php echo base_url();?>assets/js/loadpage.js"></script>