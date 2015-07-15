<?php require_once '_globals.php'; ?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MidoNet - Open Source Network Virtualization for OpenStack</title>
    <meta name="description" content="MidoNet is an Apache licensed production grade network virtualization software for Infrastructure-as-a-Service (IaaS) clouds.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="/reset.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://j.wovn.io/0" data-wovnio="key=EVJIv"></script>
  </head>

  <body>

    <section class="header">
      <topbutton>
        <script async defer src="http://slack.midonet.org/slackin.js"></script>
        <a class="github-button" href="https://github.com/midonet/midonet" data-count-href="/midonet/midonet/stargazers" data-count-api="/repos/midonet/midonet#stargazers_count">Star</a>
        <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
      </topbutton>
      <div class="wrapper">
        <nav>
          <a href="#help" class="scrollto">Help</a>
          <a href="#quickstart" class="scrollto">Quick Start</a>
          <a href="#resources" class="scrollto">Resources</a>
          <a href="http://blog.midonet.org">Blog</a>
          <a href="http://wiki.midonet.org">Wiki</a>
          <a href="http://docs.midonet.org">Docs</a>
          <a href="/midonet-tv">TV</a>
          <a href="http://planet.midonet.org">Planet</a>
        </nav>
        <h1>MidoNet</h1>
        <h2>Open-source network virtualization</h2>
        <h3>MidoNet is an Apache licensed production grade network virtualization software for Infrastructure-as-a-Service (IaaS) clouds.</h3>
        <a href="#quickstart" class="download-button">Get Started in Minutes</a>
        <a href="/midonet-tv" class="download-button">Watch Videos</a>
      </div><!--END WRAPPER-->
    </section>

    <section class="features clearfix">
      <div class="wrapper">
        <div id="mido-does">
          <span class="icon"></span>
          <h4>What MidoNet Does</h4>
          <p>
            MidoNet decouples your IaaS cloud from your network hardware, creating an intelligent software abstraction layer between your end hosts and your physical network.
            <br><br>
            This network abstraction layer allows the cloud operator to move what has traditionally been hardware-based network appliances into a software-based multi-tenant virtual domain.
          </p>
        </div>
        <div id="mido-enables">
          <span class="icon"></span>
          <h4>MidoNet Enables</h4>
          <ul>
            <li><span>Reduced complexity of physical network</span></li>
            <li><span>High availability (any server, any network service, any time)</span></li>
            <li><span>Scalability through hierarchy</span></li>
            <li><span>Reduced protocols</span></li>
            <li><span>Optimized network traffic with minimal overhead</span></li>
            <li><span>Vastly improved fault tolerance</span></li>
          </ul>
          <p>
            You'll gain superior network efficiency, reduced dependence on overworked IT staff, and the agility to respond instantly to changing demands.
          </p>
        </div>
        <div id="mido-features">
          <span class="icon"></span>
          <h4>Features</h4>
          <ul>
            <li><span>Virtual L2 Distributed Switching</span></li>
            <li><span>Virtual L2 Isolation</span></li>
            <li><span>Virtual L3 Distributed Routing</span></li>
            <li><span>Virtual L3 Isolation</span></li>
            <li><span>L4 Services (Load Balancing, Firewall)</span></li>
            <li><span>NAT / Floating IP's</span></li>
            <li><span>Access Control Lists (ACLs) and Security Groups</span></li>
            <li><span>Restful API</span></li>
            <li><span>OpenStack integration</span></li>
          </ul>
        </div>
      </div>
    </section>

    <section id="videointro">
      <div>
        <center>
          <h3>MidoNet brings production-grade distributed overlay networking to OpenStack</h3>
          <iframe style="margin-top: 40px" width="853" height="480" src="//www.youtube.com/embed/Qoy62Fkd7xQ" frameborder="0" allowfullscreen=""></iframe>
        </center>
      </div>
    </section>

    <section class="large-graphic">
      <div class="wrapper">
        <img src="i/graphic.png" alt="">
      </div>
    </section>

    <section id="quickstart">
      <div>
        <center><h1><a class="anchor" name="quickstart">Quickstart</a></h1></center>
      </div>
      <div class="qbox">
        <p class="desc">
          Try MidoNet in a few steps.
          <br>
          <br>
          <div class="content">
            <h2>I want to run it now!</h2>
            <br>
            <p>Execute this command <b>inside an Ubuntu 14.04 Virtual Machine</b> with at least 4Gb of memory (8Gb recommended)</p>
            <pre>$ wget -qO- http://midonet.org/midonet-quickstart.sh | sudo bash</pre>
            <p>This command will install a MidoNet 2015.01 with OpenStack Juno. It will give the instructions to log in into Horizon once finished.</p>
            <br>
            <br>
            <h2>I prefer to deploy it by myself</h2>
            <br>
            <p>
              If you don't want to run third-party bash script code as root in your Virtual Machine, follow the <a href="http://wiki.midonet.org/MidoNet-allinone">MidoNet all-in-one tutorial</a>in MidoNet wiki.
            </p>
            <br>
            <br>
            <h2>Next Steps</h2>
            <br>
            <p>Check out our <a href="http://wiki.midonet.org/GettingStartedMidonet">Getting Started Guide</a> for an overview of MidoNet with some tips on using the MidoNet Command Line Interface (CLI) along with links to more information about MidoNet details.</p>
          </div>
        </p>
      </div>
    </section>

    <section id="help" class="help">
      <div>
        <h1 class="section-heading"><a class="anchor" id="help">Getting Help</a></h1>
        <p class="desc">
          Thanks to a very active MidoNet community, there are a number of different ways that you can get answers to your MidoNet-related questions. The MidoNet project already has some great&nbsp; <a href="http://docs.midonet.org">documentation</a>, a growing&nbsp;<a href="http://wiki.midonet.org">wiki</a>, and a few other resources which you can find links to below
        </p>
      </div>
      <div class="clearfix gbox">
        <div>
          <h2 class="sub-heading">Community Support</h2>
        </div>
        <div class="col-one-third">
          <div class="box"><h3>Ask</h3>
            <p>Head over to Stack Exchange where you might find the answer you're looking for.  If not, feel free to ask a new question.  Community members are actively checking and voting up the best questions.</p>
            <br>
            <br>
            <br>
            <p><strong><a href="https://stackoverflow.com/questions/tagged/midonet">MidoNet on StackExchange</a></strong></p>
          </div>
        </div>
        <div class="col-one-third">
          <div class="box">
            <h3><strong>Slack Chat</strong></h3>
            <p>Documentation doesn&rsquo;t always cover every situation, and conversation is often the best option. &nbsp;Community members are usually around to provide assistance and answer questions. Don&rsquo;t forget to thank the helpful community volunteers for providing this service!</p>
            <br>
            <a href="http://slack.midonet.org">Slack Chat</a>
            <strong><br></strong>
          </div>
        </div>
        <div class="col-one-third">
          <div class="box">
            <h3 >Mailing Lists</h3>
            <p >If chat isn&rsquo;t your thing, or no one is around to help, feel free to ask your questions on the mailing lists. &nbsp;</p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p><strong><a href="http://lists.midonet.org">Sign up for the mailing lists</a></strong></p>
          </div>
        </div>
      </div>
    </section>

    <section id="contribute">
      <div>
        <h1 class="section-heading"><a class="anchor" id="contribute">Want to Contribute?</a></h1>
        <div class="clearfix">
          <div class="col-one-third">
            <div class="align-center">
              <a href="http://github.com/midonet"><img src="i/GitHub_Logo.png" width="300" height="123" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="http://github.com/midonet">github.com/midonet</a>
            </div>
          </div>
          <div class="col-one-third">
            <div class="align-center">
              <a href="http://slack.midonet.org"><img src="i/chat.png" border="0">MidoNet Slack Community</a>
              <strong><br></strong>
            </div>
          </div>
          <div class="col-one-third">
            <div class="align-center">
              <a href="https://lists.midonet.org" target="_self"><img src="i/mail.png" border="0"></a><br>
              <a href="https://lists.midonet.org">lists.midonet.org</a>
            </div>
          </div>
        </div>
        <div class="guide-link">
          <a class="document" href="http://wiki.midonet.org/How%20to%20contribute" target="_self">View Complete Contribution Guide</a>
        </div>
      </div>
    </section>

    <section class="members intro">
      <div class="intro">
        <br>
        <p>MidoNet is committed to being a truly open community. The project idea originated from the team at Midokura, whom released the code into the wild in November of 2014 under the Apache license. We have a thriving community of users and contributors to the MidoNet project. Want to join the community? Check our guide on <a href="http://wiki.midonet.org/How%20to%20contribute">how to contribute</a></p>
      </div>
    </section>

    <section class="users clearfix">
      <div class="wrapper">
        <h1 class="section-heading">Our Members</h1>
        <br>
        <div id="users">
          <a href="https://www.8x8.com/" rel="nofollow"><img src="i/8x8.png" width=200 border="0"></a>
        </div>
        <div id="users">
          <a href="http://www.advantech.com/" rel="nofollow"><img src="i/advantech.png" width=200 border="0"></a>
        </div>
        <div id="users">
          <a href="http://www.bit-isle.co.jp/en/" target="_blank" rel="nofollow"><img src="i/bit-isle.png" width=200 border="0"></a>
        </div>
      </div>
      <div class="wrapper">
        <div id="users">
          <a href="http://www.broadcom.com" target="_blank" rel="nofollow"><img src="i/broadcom.png" width=200 border="0" style="margin-top:-24px"></a>
        </div>
        <div id="users">
          <a href="https://www.cumulusnetworks.com/" target="_blank" rel="nofollow"><img src="i/cumulus.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
        <div id="users">
          <a href="https://www.eucalyptus.com/" target="_blank" rel="nofollow"><img src="i/eucalyptus.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
      </div>
      <div class="wrapper">
        <div id="users">
          <a href="https://www.fujitsu.com/" target="_blank" rel="nofollow"><img src="i/fujitsu.png" width=200 border="0" style="margin-top:-24px"></a>
        </div>
        <div id="users">
          <a href="http://www.idcf.jp/english/" target="_blank" rel="nofollow"><img src="i/idc.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
        <div id="users">
          <a href="http://www.kvhasia.com/" target="_blank" rel="nofollow"><img src="i/kvh.png" width=200 border="0"></a>
        </div>
      </div>
      <div class="wrapper">
        <div id="users">
          <a href="http://www.mellanox.com" target="_blank" rel="nofollow"><img src="i/mellanox.png" width=200 border="0" style="margin-top:-24px"></a>
        </div>
        <div id="users">
          <a href="http://www.midokura.com" target="_blank" ><img src="i/midokura.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
        <div id="users">
          <a href="https://www.mirantis.com/" target="_blank" rel="nofollow"><img src="i/mirantis.png" width=200 border="0" style="margin-top:-24px"></a>
        </div>
      </div>
      <div class="wrapper">
        <div id="users">
          <a href="http://www.nimboxx.com/" target="_blank" rel="nofollow"><img src="i/nimboxx.png" width=200 border="0" style="margin-top:36px"></a>
        </div>
        <div id="users">
          <a href="http://quantaqct.com/" target="_blank" rel="nofollow"><img src="i/quanta.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
        <div id="users">
          <a href="http://www.redhat.com/" target="_blank" rel="nofollow"><img src="i/redhat.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
      </div>
      <div class="wrapper">
        <div id="users">
          <a href="http://www.solinea.com/" target="_blank" rel="nofollow"><img src="i/solinea.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
        <div id="users">
          <a href="http://www.stratoscale.com/" target="_blank" rel="nofollow"><img src="i/stratoscale.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
        <div id="users">
          <a href="http://www.suse.com/" target="_blank" rel="nofollow"><img src="i/suse.png" width=200 border="0"></a>
        </div>
      </div>
      <div class="wrapper">
        <div id="users">
          <a href="http://www.ubuntu.com" target="_blank" rel="nofollow"><img src="i/ubuntu-logo.png" width=200 border="0" style="margin-top:12px"></a>
        </div>
        <div id="users">
          <a href="http://www.zetta.io/" target="_blank" rel="nofollow"><img src="i/zetta.png" width=200 border="0" style="margin-top:24px"></a>
        </div>
      </div>
    </section>

    <section class="case-studies">
      <div id="slide-wrapper"
           style="max-width: 960px!important;
                  margin: 0 auto!important;
                  max-height: 300px!important;">
        <div id="slides">
          <div class="study study1">
            <p>"Open source has brought incredible innovation and traction to both compute and storage virtualization technologies, while historically, most of what we've seen from the networking space has been proprietary," said Chris Wright, technical director, SDN and NFV, Red Hat. "It is promising that the many benefits of 'open' are now being acknowledged by leaders in that space, and by Midokura announcing plans to open source their network virtualization offering, they are helping to enable the truly open software-defined datacenter."</p>
            <span class="person">Chris Wright, Technical Director, SDN and NFV at Red Hat</span>
          </div>
          <div class="study study2">
            <p>"Network function virtualization and software-defined networking are buzz words in many corners of the cloud industry. But to our customers, reliable performance of virtualized network fabrics is an essential element of their long-term cloud infrastructure strategy. Working with the Midokura community, we look forward to helping create a new and powerful open source option for our customers."</p>
            <span class="person">Mike Yang, general manager, Quanta Cloud Technology (QCT)</span>
          </div>
          <div class="study study3">
            <p>"This is another testament that the networking industry is embracing open source as the right path forward for network virtualization and SDN. More open source code means more choice for developers and users and is good for the entire industry. We look forward to seeing how OpenDaylight and the MidoNet project can interoperate to benefit users of any size and scale." </p>
            <span class="person">Neela Jacques, executive director, OpenDaylight Project</span>
          </div>
          <div class="study study4">
            <p>"Midokura's decision to open source MidoNet fits perfectly in the open future that we at Mirantis believe in. This will be the only open solution that is not driven by a hardware networking vendor and we're excited to be a part of it. We look forward to being an active member of the MidoNet community ongoing." </p>
            <span class="person">Boris Renski, Co-Founder and CMO, Mirantis </span>
          </div>
          <div class="study study5">
            <p>"We're excited to see Midokura, an early Cumulus Networks overlay partner, join the community and encourage customers to implement and deploy OpenStack solutions. Open Source overlays like Midonet complement the Cumulus Linux networking OS underlay to enable large scale agile network infrastructure"</p>
            <span class="person">Nolan Leake, CTO and co-founder, Cumulus Networks</span>
          </div>
          <div class="study study6">
            <p>"We are thrilled to be a part of the MidoNet open source project. Midokura and Solinea are both long time contributors to the OpenStack community and this partnership will help bring cloud services and vendor-agnostic network virtualization to the masses." </p>
            <span class="person">Ken Pepple, CTO, Solinea</span>
          </div>
          <div class="study study7">
            <p>"We are thrilled that Midokura is releasing the source code for MidoNet, helping users worldwide reach their goals of a production-ready cloud. The move to an open source model levels the playing field for Software-Defined Networking, supplying the last piece of the puzzle in the OpenStack ecosystem." </p>
            <span class="person">Dag Stenstad, CTO, Zetta.IO</span>
          </div>
          <div class="study study8">
            <p>"We are committed to open development and recognize the value open MidoNet can add to the OpenStack community. The availability of an open Software Defined Networks package from Midokura that takes advantage of our ConnectX-3 10/40 Gigabit Ethernet NIC with VXLAN offloads will accelerate the adoption and evolution of network virtualization in OpenStack environments." </p>
            <span class="person">Kevin Deierling, vice president of marketing, Mellanox Technologies</span>
          </div>
          <div class="study study9">
            <p>"As one of Midokura's early investors, we have been a long time believer and proponent of the MidoNet technology. This open source project is exactly what the OpenStack community needs and we are excited to be a part of it. We can now easily and effectively enhance OpenStack-based clouds with network virtualization." </p>
            <span class="person">Takeshi Narisako, executive officer and chief director of cloud &amp; IT solution, Bit-isle inc. </span>
          </div>
          <div class="study study10">
            <p>"Midokura is boldly addressing the market need for a production-ready, SDN solution free of vendor lock-in. This is an exciting contribution to the open source community that will accelerate private cloud adoption. We are thrilled to offer Eucalyptus users AWS compatible hybrid cloud solutions with true VPC support, powered by MidoNet." </p>
            <span class="person">Shashi Mysore, VP Products, Eucalyptus</span>
          </div>
          <div class="study study11">
            <p>"IDC Frontier is very much pleased that MidoNet goes open-source.  We believe this will attract more users who are avoiding vendor lock-in to MidoNet, which has rich experiences with network virtualization.  We also believe this will further expand its user community and accelerate the process of function enhancement.  This will bring benefits to cloud service providers like IDC Frontier both in technical and business perspectives, as well as abilities to provide high quality services to their customers.  I am hoping MidoNet becomes the de facto standard of network virtualization someday." </p>
            <span class="person">Masaki Hayashi, Director of Technology Development Div., IDC Frontier Inc.</span>
          </div>
          <div class="study study12">
            <p>"We at KVH are focused on continuously advancing our private cloud business to meet evolving customer requirements. With the MidoNet open source project, we can now provide cost-effective and agile virtual networking to our customers. Having such a large contribution in networking technology to the open community will help accelerate innovation and adoption of OpenStack." </p>
            <span class="person">Yoshiyuki Hamada, Vice President of Technology, KVH</span>
          </div>
          <div class="study study13">
            <p>"We are excited to be a part of the industry's first and only open overlay network virtualization platform. We at Stratoscale are delivering the first pure-play software solution for hyper-convergence infrastructure by reinventing virtualization at scale - this project falls perfectly in line with our mission. We are excited to be a part of the MidoNet ecosystem." </p>
            <span class="person">John Mao, Director of Business Development, Stratoscale</span>
          </div>
          <div class="study study14">
            <p>"The Midokrua open source project is an important step to making Openstack production ready for large scale cloud deployment.” said Eli Karpilovski Director of Product Marketing at Broadcom. “Broadcom is supporting the MidoNet project, by contributing our new Broadview™ instrumentation tools, which will extend the visibility capabilities into the Cloud infrastructure and accelerate maturity of OpenStack."</p>
            <span class="person">Eli Karpilovski, Director of Product Marketing, Broadcom</span>
          </div>
          <div class="study study15">
            <p>"We are pleased to have partnered with Midokura, one of the leading network virtualization providers in the world. With the launch of the MidoNet open source project, we can now offer market-leading global solutions to enhance OpenStack-based clouds with network virtualization to meet the needs of cloud customers." </p>
            <span class="person">Takashi Fujiwara, Head of platform software business unit, Fujitsu Limited</span>
          </div>
        </div><!--END SLIDES-->
      </div><!--END SLIDEWRAPPER-->
    </section>

    <section id="professional-support" class="professional-support">
      <div>
        <h1 class="section-heading"><a class="anchor" id="professional-support">Professional Support</a></h1>
        <p class="desc">
          If you still can&rsquo;t find the answers you&rsquo;re looking for, there are professional support options available as well, providing 24x7 SLA backed support for MidoNet.
        </p>
      </div>
      <div class="clearfix">
        <div class="col-one-third">
          <img src="https://lh3.googleusercontent.com/aSsO-V1qn6Nm0BK1Zqv6M92mDYL4rvOlueATNdFkw05y55UlkGCh2RG_Jq-Srci9rez7r3pan7us1T0_936TW--eu4pcacrL2aWoKmPi1k16SlkHJpUjlvt8yHDFPpgN1w" height="60" style="position:relative;top:18px;z-index:0;">
        </div>
        <div class="col-two-third">
          <div class="box" style="margin-top:16px;">
            Midokura has worked hard to provide the best support options available for MidoNet. &nbsp;Midokura is the right partner for your production grade deployment of MidoNet. &nbsp;Providing 24x7 follow-the-sun support with their global team, comprehensive support portal, and top-notch professional services by the experts. &nbsp;You can rest easy because Midokura&rsquo;s got your back. <strong><a href="http://midokura.com/support">Learn More</a></strong>
          </div>
        </div>
      </div>
    </section>

    <section id="resources">
      <div class="gbox">
        <h1 class="section-heading">
          <a class="anchor" name="resources">Additional Resources</a><a class="anchor" name="downloads"></a>
        </h1>
        <div class="clearfix">
          <div class="col-half">
            <div class="box">
              <h3>Links</h3>
              <ul class="rlinks">
                <li>
                  <p><a href="http://blog.midonet.org"><strong>MidoNet Blog -</strong> http://blog.midonet.org</a></p>
                </li>
                <li>
                  <p><a href="http://midonet.org/#downloads"><strong>Downloads - </strong>http://midonet.org/#downloads</a></p>
                </li>
                <li>
                  <p><a href="http://docs.midonet.org"><strong>MidoNet Docs - </strong> http://docs.midonet.org</a></p>
                </li>
                <li>
                  <p><a href="http://github.com/midonet"><strong>Source Code - </strong> http://github.com/midonet</a></p>
                </li>
                <li>
                  <p><a href="http://wiki.midonet.org"><strong>MidoNet Wiki - </strong>http://wiki.midonet.org</a></p>
                </li>
                <li>
                  <p><a href="http://lists.midonet.org"><strong>Mailing Lists - </strong> http://lists.midonet.org</a></p>
                </li>
                <li>
                  <p><a href="https://stackoverflow.com/questions/tagged/midonet"><strong>Ask - </strong>On StackOverflow</a></p>
                </li>
                <li>
                  <p><a href="https://midonet.atlassian.net"><strong>Jira - </strong>https://midonet.atlassian.net/</a></p>
                </li>
                <li>
                  <p><a href="https://review.gerrithub.io/#/q/project:midonet/midonet"><strong>Code Reviews - </strong>On Gerrithub</a></p>
                </li>
                <li>
                  <p><a href="/midonet-tv"><strong>Videos & Presentations </strong>on MidoNet TV</a></p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-half">
            <div class="box">
              <h3>Downloads</h3>
              <div class="desc-small">
                The easiest way to get started is to use the <a href="#quickstart" class="scrollto">quickstart</a>, but if you're ready to get started with a more powerful deployment, you can find links to the software repositories below. Don't forget to refer to the <a href="http://docs.midonet.org">documentation</a> for assistance with manual installations.
              </div>
              <ul class="dlinks">
                <li><a href="http://repo.midonet.org"><strong>Package Repositories  - </strong>http://repo.midonet.org</a></li>
                <li><a href="https://github.com/midonet/midonet/archive/master.zip"><strong>Source&nbsp;Code&nbsp;zip - </strong>http://github.com/midonet/...</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include '_footer.php'; ?>

    <!--JS-->

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="jquery.slides.min.js"></script>
    <script src="jquery.easing.min.js"></script>
    <script src="site.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-56283377-1', 'auto');
      ga('send', 'pageview');
    </script>

  </body>
</html>
