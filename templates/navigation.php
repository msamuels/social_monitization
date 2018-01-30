<div class="navbar navbar-custom navbar-fixed-top sticky" role="navigation">
    <div class="container">

        <!-- Navbar-header -->
        <div class="navbar-header">
            <!-- Responsive menu button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="zmdi zmdi-menu"></i>
            </button>

            <!-- LOGO -->
            <a class="navbar-brand logo" href="/">
                <span><img src="/images/shareitcamp-logo.svg"/></span>
            </a>

        </div>
        <!-- end navbar-header -->

        <!-- menu -->
        <div class="navbar-collapse collapse" id="navbar-menu">

            <!-- Navbar left -->
            <ul class="nav navbar-nav nav-custom-left">
                <li><a href="/faqs">faq</a></li>

                <?php if (!isset($_SESSION['user_type'])) { ?>
                    <li><a href="/about-us">about us</a></li>
                    <li><a href="/organizations">for organizations</a></li>
                    <li><a href="/#projects">projects</a></li>

                <?php } else { ?>
                    <!-- Supporter Links -->
                    <?php if ($_SESSION['user_type'] == "supporter") { ?>
                        <li><a href="/supporter/campaigns">My Campaigns</a></li>
                        <li><a href="/supporter/campaigns/pending">Support Campaigns</a></li>
                        <li><a href="/rewards">Rewards</a></li>
                        <li><a href="/my-account">Account</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['user_type'] == "producer") { ?>
                        <li><a href="/campaigns">My Campaigns</a></li>
                        <li><a href="/member-campaigns">Members</a></li>
                        <li><a href="/create-campaign">Create Campaigns</a></li>
                        <li><a href="/create-reward">Rewards</a></li>
                        <li><a href="/invoices">Invoices</a></li>
                        <li><a href="/account">Account</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['user_type'] == "admin") { ?>
                        <li><a href="/create-reward">Create Rewards</a></li>
                        <li><a href="/admin-rewards">List Rewards</a></li>
                        <li><a href="/admin/campaigns">Approve Campaigns</a></li>
                        <li><a href="/admin/supporters">Supporters</a></li>
                    <?php } ?>

                <?php } ?>

            </ul>

            <!-- Navbar right -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php if (!isset($_SESSION['user_type'])) { ?>
                        <a href="/login">Login</a>
                    <?php } else { ?>
                        <a href="/logout">Logout</a>
                    <?php } ?>
                </li>

                <?php if (!isset($_SESSION['user_type'])) { ?>
                <li>
                    <a href="/get-started/supporter/register" class="btn btn-inverse btn-bordered navbar-btn">Signup</a>
                </li>

                <?php } ?>

            </ul>

        </div>
        <!--/Menu -->
    </div>
    <!-- end container -->
</div>
<!-- End navbar-custom -->
