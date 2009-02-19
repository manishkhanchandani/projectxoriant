<?php
require_once('../config.inc.php');
require_once('../pipeline.factory.class.php');
parse_config_file('../html2ps.config');

function convert_to_pdf($pdf) {

	class MyDestinationFile extends Destination {
		var $_dest_filename;

		function MyDestinationFile($dest_filename) {
			$this->_dest_filename = $dest_filename;
		}

		function process($tmp_filename, $content_type) {
			copy($tmp_filename, $this->_dest_filename);
		}
	}


	class MyDestinationDownload extends DestinationHTTP {
		function MyDestinationDownload($filename) {
			$this->DestinationHTTP($filename);
			$GLOBALS['PDFOutFileName'] = $filename;
		}

		function headers($content_type) {
			return array(
				"Content-Disposition: attachment; filename=".$GLOBALS['PDFOutFileName'].".".$content_type->default_extension,
				"Content-Transfer-Encoding: binary",
				"Cache-Control: must-revalidate, post-check=0, pre-check=0",
				"Pragma: public"
			);
		}
	}

	class MyFetcherLocalFile extends Fetcher {
	var $_content;

		function MyFetcherLocalFile() {
			$this->_content = "Test<!--NewPage-->Test<pagebreak/>Test<?page-break>Test";
		}

		function get_data($dummy1) {
			return new FetchedDataURL($this->_content, array(), "");
		}

		function get_base_url() {
			return "";
		}
	}



	$media = Media::predefined("A4");
	$media->set_landscape(false);
	$media->set_margins(array('left'   => 0,
        	                  'right'  => 0,
	                          'top'    => 0,
	                          'bottom' => 0));
	$media->set_pixels(1024); 

	$GLOBALS['g_config'] = array(
                  'cssmedia'     => 'screen',
                  'renderimages' => true,
                  'renderforms'  => false,
                  'renderlinks'  => true,
                  'renderfields'  => true,
                  'mode'         => 'html',
                  'debugbox'     => false,
                  'draw_page_border' => false,
                  );

	$g_px_scale = mm2pt($media->width() - $media->margins['left'] - $media->margins['right']) / $media->pixels;
	$g_pt_scale = $g_px_scale * 1.43; 

	$pipeline = new Pipeline;
        $pipeline->configure($GLOBALS['g_config']);
	$pipeline->fetchers[] = new MyFetcherLocalFile();
	// $pipeline->destination = new MyDestinationFile($pdf);
	$pipeline->destination = new MyDestinationDownload($pdf);
	$pipeline->data_filters[] = new DataFilterHTML2XHTML;
	$pipeline->pre_tree_filters = array();
	$header_html    = "test";
	$footer_html    = "test";
	$filter = new PreTreeFilterHeaderFooter($header_html, $footer_html);
	$pipeline->pre_tree_filters[] = $filter;
	$pipeline->pre_tree_filters[] = new PreTreeFilterHTML2PSFields();
	$pipeline->parser = new ParserXHTML();
	$pipeline->layout_engine = new LayoutEngineDefault;
	$pipeline->output_driver = new OutputDriverFPDF($media);

	$pipeline->process('', $media);
}


/*$html = '<link rel="stylesheet" href="./templates/styles.css" title="stylesheet" type="text/css" /> 
			 <style>
			 body{		 
				 background:none;
				 background-color:#FFFFFF;
			 }
			 .top_line_print{
			 	padding:10px;
				text-align:left;
			 }
			 .top_line_print span{
			 	font-weight:bold;
				text-align:left;
				float:left;
			 }
			 .top_line_print input{
			 	float:right;
			 }
			 .clear{
			 	clear:both;
			 }
			 div.swans_content .tips_information_one{
			 	padding:10px;
			 }
			 
			 </style>


<div class="top_line_print">
	<p>
	<input type="image" src="./images/close_tab.gif" onClick="window.close();"/>
	<input type="image" src="./images/print_tab.gif" onClick="window.print();"/>	
	<!--<span>My Trip Folder:</span>-->
	</p>

	<div class="clear"></div>
</div>
				 
		
		<div class="swans_content">			
			<div class="tips_info_top">					
				<p class="trip_info"><span><strong>PdfTest</strong></span></p>
			</div>
			<div>
																<!---->
	
				<div class="tips_information_one">
					<div >

													<p><span style="font-weight: bold;">Passports<br /></span><img style="float: right;" src="images/mls/bag2.gif" alt="" width="132" height="175" /><span style="font-style: italic;"> Every</span> member of the family, down to your youngest child, should have a valid passport.<br />Check for expiration dates. I check ours each time I <span style="font-style: italic;">plan</span> a trip. A passport should be valid <br />for at least six months after your departure date.</p>
<p><strong>Visas<br /></strong>You need to have blank <span style="font-style: italic;">visa</span> pages not <span style="font-style: italic;">endorsement</span> pages for every country you enter. <br />If you do not have a sufficient number of pages, you will be either stopped before you <br />board your final international flight or turned back at the border. <br />(Yes, this happened to us)!</p>

<p>Another gotcha. Countries that don&rsquo;t require a visa may still need to stamp your entry and departure on a visa page.</p>
<p>Check <span style="font-style: italic;">before</span> you leave with the appropriate consulate for visa requirements to avoid disappointments. On a recent boating trip down the coast of Turkey, we planned to visit the Greek island of Chios. Although we were told that we didn&rsquo;t need visas, we were denied entry without them.</p>
<p><strong>Notarized Permission Letter<br /></strong>Because of concerns about illegal transport of children across international borders, if only one parent is traveling with the child, he or she should carry a notarized permission letter from the other parent or relevant custody papers.</p>
<p><strong>Backup Key Documents<br /></strong>Before you leave, make 2 copies of passports, visas, tickets &amp; immunization records. Hide one copy in a suitcase somewhere and leave the other copy at your office or with a friend or relative to hold in case of emergency.</p>

<p><strong>Luggage<br /></strong><img style="float: right;" src="images/mls/bag.gif" alt="" width="108" height="157" /> Leave your Louis Vuitton at home. You need to travel light. We use Eagle Creek duffle bags. Large, not extra large (too long for conveyer belts). One for each member of the family, and an extra duffle for specialized gear. All bags need individual tags, so it is easy to know which room they need to be delivered too. And we will often pack bags within bags, (light-weight nylon), so if we are going to multiple locations, requiring different clothes, we don&rsquo;t have to unpack what we don&rsquo;t need.</p>
<p>For the plane, I recommend <a href="http://www.swissarmy.com/travelgear/Pages/Category.aspx?category=carryon&amp;">Victorinox Swiss Army carry-on bags</a>. They are legal size, fit under the seat, protect electronics and hold enough to keep each child occupied on a long flight. I also recommend that you pack a change of clothes, prescription drugs and any valuables in the carry-on, just in case you arrive before your luggage does.</p>
<p><strong>Weight Limits<br /></strong>There are strict weight limits at a growing number of International airports. Doesn&rsquo;t matter if you are flying first class. Doesn&rsquo;t matter if you pay extra for the weight. This is not an aviation rule. It&rsquo;s a union rule. Union workers do not have to lift bags over 70lb (32kg).</p>
<p>I always pack a light-weight duffle bag in case I need to shift weight around. Also find the extra bag useful for bringing back our shopping finds.</p>					
					</div>

				<div class="clear"></div>
				</div>
								<!---->
	
				<div class="tips_information_one tips_information_one_color">
					<div >
													<p><strong>Accomodations<br /></strong>When booking, specify the rooms to be single or double occupancy.  Many times single rooms have a twin bed.  If you book a room with an ocean view, that is what you will get. You may not be able to upgrade on site.  If you must have an oceanfront, mountain view, canal view, Kremlin view, please book that room category.</p>
<p><strong>Transfers/local transportation<br /></strong>When booking, specify private sedan or stretch limo.  How many hours will the car be at your disposal?  Many times cars are booked back-to-back.  Sometimes tips are included in the cost of the car hire.  If you would like a particular car model, please specify in advance.  In Europe you would usually get a Mercedes E-Class or similar.</p>

<p><strong>Drivers and driver/guides<br /></strong>Drivers and driver/guides often half days (3 to 4 hours) or full days (6 to 8 hours per day).  Usually any overtime hours, additional mileage/services must be requested and paid for locally.  Many times you will have a driver/guide.  If your preference is a certified guide, in addition to the driver, please confirm such a reservation in advance.</p>
<p><strong>Baggage Handling<br /></strong>Before departure&mdash;if you are checking luggage, please make sure to comply with the weight allotments.  Check with the airline agent about the size, weight and number of pieces allowed. You may find that flights to certain destinations around the holidays are even more restrictive. In some cases you may only be allowed one piece of luggage per person.</p>
<p>All the above could translate to your luggage not traveling with you.  A solution to all this would be to ship your luggage prior to departure.  It is a very common occurrence these days.</p>
<p>On the ground&mdash;keep in mind the number of bags you will be taking with you.  This is very important with when confirming transfers.  If you confirm a stretch limo because of a large party, these cars have relatively little luggage space.  You would be better off with 2 sedans or have the concierge hire a van to transfer the luggage.</p>
<p><strong>Travel Insurance<br /></strong>Travel Insurance offers peace of mind by covering some of the risks of travel. When one purchases a package through a company specializing in consumer travel, you are automatically offered Travel Insurance.  These travel suppliers have policies that cover the basic needs of the traveler.  Some vendors offer policies to cancel for any reason.  Others offer cancellation for medical reasons only.</p>
<p>If your tour company does not offer travel insurance or if you are booking your trip directly and it includes airline, a prepaid or non-cancellable hotel, we strongly recommend the purchase of insurance from a third party.  The reason we mention,  "strongly recommend" is that is very hard to predict if an elderly parent or a young child may have the flu at the time of the trip.  Instead of taking the loss of all the pre-paid components, you can submit a claim to your Travel Insurance Company.  In this case you will have to go to a third party insurance company.  All companies will offer a comprehensive plan plus some optional coverage.  We have listed below the four largest Travel Insurance Companies.</p>

<p style="padding-left: 30px;"><a href="https://www.globaltravelshield.com/">Global Travel Shield</a>, underwritten by AMEX Assurance Company<br />Tel: 800 332 4899</p>
<p style="padding-left: 30px;"><a href="http://www.travelguard.com/">Travel Guard</a><br />Tel: 800 826 4919</p>
<p style="padding-left: 30px;"><a href="http://www.accessamerica.com/">Access America</a><br />Tel: 800 284 8300</p>
<p style="padding-left: 30px;"><a class="tips_link" href="https://www.travelex-insurance.com/consumer/welcome.aspx">Travelex</a><br />Tel: 800 228 9792</p>
<p>Coverage may vary by Insurance Company, please verify the points your Certificate of Insurance/Policy includes.  We cannot guarantee that the covered points below are included in your policy.  Most travel insurance covers the following basic points:</p>
<p style="padding-left: 30px;"><strong>Emergency Medical</strong> only covers medical emergencies incurred while traveling.  The policy will have clauses/restrictions about pre-existing conditions.</p>

<p style="padding-left: 30px;"><strong>Evacuation Insurance</strong> covers the cost of getting you to a place where you can receive medical treatment in the event of an emergency.  Sometimes this coverage will get you home after a medical emergency.  Most of the time will just get you to the nearest hospital.  Some insurance companies cover the cost of a hospital companion.  You must check with insurance carrier prior to purchasing.</p>
<p style="padding-left: 30px;">Keep in mind that you will not be covered by your policy if you are involved in an activity your insurer considers dangerous (bungee jumping, skydiving, scuba diving, skiing, etc).  Some companies sell supplementary adventure sports coverage.</p>
<p style="padding-left: 30px;"><strong>Baggage Loss</strong> protection for damaged, lost or stolen baggage, including those checked-in and carried-on is usually part of the comprehensive insurance plan.</p>
<p style="padding-left: 30px;"><strong>Baggage Delay</strong> covers necessary replacement items after a baggage delay.  This coverage can not be purchased individually, it is usually included in a comprehensive plan.</p>
<p style="padding-left: 30px;"><strong>Pre-existing Condition</strong> is any condition (injury or illness) which causes you to have medications adjusted, exhibit symptoms, or seek treatment during the 60 days prior to and including the date your insurance coverage goes into effect.  If you already have a medical condition but is controlled and stable throughout that 60 day period (that is if you don&#039;t need to change your medication, treat or have symptoms), it is not considered pre-existing condition.  If your condition is related to Pregnancy, refer to your policy for additional details.  All travel protection plan contains restriction and limitations.</p>

<p style="padding-left: 30px;"><strong>Air flight Insurance</strong> covers accidental loss of life and serious injuries.</p>
<p style="padding-left: 30px;"><strong>Trip Cancellation/Interruption</strong> covers nonrefundable costs if a trip is cancelled or interrupted due to a covered reason.</p>
<p style="padding-left: 30px;"><strong>Collision coverage for rental cars</strong> may be included in some comprehensive insurance plans or available as an upgrade.  Certain countries such as Italy, car insurance is not a choice.  It must be purchased.  Check with your insurance company for the inclusions.</p>
<p style="padding-left: 30px;"><strong>Trip Delay</strong> covers the cost of hotel accommodations and other necessary expenses for up to x-days if a flight is delayed or cancelled or if the traveler misses a connection.  Usually this is also included in the comprehensive insurance policy. Check with your insurance supplier about the applicable inclusions.</p>
<p style="padding-left: 30px;"><strong>Travel Warnings</strong>. Check the US State Department website (www.travel.state.gov ) for travel warnings because medical, cancellation insurance is not covered if the country you are traveling is on the warning list.</p>

<p><strong>Hassle Free Travel<br /></strong>This are just tidbits to make your travel flow according to plan. Arrive about 3 hours before departure for your international flights.  Arriving at the last minute may result on the loss of your seat or not allowing time for the luggage to make an oversold flight.  After checking in, enjoy and relax at the airline first class lounge.</p>
<p>Review all your planned sightseeing at the time the reservations are made.  If there has been several months from the reservation and departure, review the itinerary at least a week before departure, this may allow changes.</p>
<p>Many venues have entrance fees that are not covered on the cost of the guide fees. When sightseeing is booked with our partners, all the fees will be included.  Flexibility in the seasoned traveler is a must.  No matter how far in advance you may plan to visit a certain location, museum, gardens and any other places of interests, the local government or managing office may change their hours of operation.  In this case, your guide will offer an alternative arrangement.</p>
<p>While on an outing with your guide, you are not obligated to invite him to join your party.  If you invite him, your guide is your guest.  You are responsible for the cost of his meal.</p>
<p>Pre-booked travel does not include:</p>
<ul>
<li>The cost of obtaining passports or visas</li>
<li>Required vaccinations or other health precautions</li>
<li>International or internal airfare (unless confirmed in advance)</li>

<li>Excess baggage</li>
<li>Shipping charges</li>
<li>Storage of excess baggage</li>
<li>Gratuities and/or tipping</li>
<li>Airport departure taxes</li>
</ul>
<p>Usually pre-booked sightseeing services are non-refundable.  Check with your agent at the time of booking.  If changes are made to a pre-booked itinerary, there will be additional cost.  Keep in mind that rates can change to reflect the fluctuation in foreign exchange markets.</p>
<p>Any additional expense incurred due to last minute changes, delay, or cancellation of any flights, or any delays or events beyond control will be the responsibility of the traveler.</p>
<p>Pack at least 24 hours prior to departure.  Then enjoy yourself, and do not rush your last night abroad.</p>					
					</div>

				<div class="clear"></div>
				</div>
								<!---->
	
				<div class="tips_information_one">
					<div >
													<p>My Little Swans is a new kind of travel site for families who want only the very best holidays for themselves and their children. Founded by Katrina Garnett who has been traveling the world with her kids for 12 years, My Little Swans began as a place for Katrina and her friends to share their adventures and discoveries. Now it&#039;s a resource for all families who want to share their travel experiences and embark on new ones. My Little Swans is the premier collection of services for families looking to create their own grand tours without compromise:</p>
<ul>
<li><strong>Sharing.</strong> Tips, advice, and insights from families like yours that have "been there." MLS founders, members, and  professionals are eager to share their discoveries and personal insights. These are the people who know all about creating the best safari in Kenya next Christmas, or getting the whole family a polo lesson in Argentina. My Little Swans is a community of like-minded families who want ready access to travel information that fits their lifestyle.</li>

<li><strong>Itinerary Builders.</strong> Everything you need to create your next family adventure including transportation,  accommodation, and sights.  Where do you build in a layover day in South Africa?  What&#039;s the best hotel for your  family in London?  What yacht charter company will equip you with the most child-friendly captain and crew? All the answers and tools are here for family travel of any length and any imagination.</li>
<li><strong>Resources.</strong> Access to the best luxury travel professional services is built into My Little Swans. All these  resources are online and can be easily accessed with your mobile device while traveling.</li>
</ul>
<p>Community, Professionals, and Resources all immediately accessible in a dynamic, growing, interactive family site:  My Little Swans.</p>
<p>&nbsp;</p>
<p><img style="float: left; margin-right: 10px;" src="images/katrina_forbes.jpg" alt="" width="153" height="192" /> Katrina Garnett is a well-known Silicon Valley CEO, software developer, and Forbes and Fortune celebrity, but for more than a decade she has also been chief trip planner for the Garnett family of five. Four times a year Katrina and her husband, Terry, take advantage of school vacations and head out with Morgan, Emerson, and Alistair to Africa, China, South America, Europe, even New York City. In classic CEO fashion, she insists every detail be right, yet still leaves plenty of room for serendipity. Now as founder of My Little Swans Katrina Garnett is ready to share her travel knowledge, her trusted partners, and her inspiration with like-minded families who believe world travel is family life at it&#039;s best. She talks about her travel experiences and her high expectations for My Little Swans in the <a href="aboutus.php?page=2">Founder Q &amp; A</a>.</p>

<p>Of course Katrina doesn&#039;t create family expeditions completely on her own. She has built a trusted network of travel partners and specialists who know how to help families create luxury travel that fits their high expectations. These travel partners are an integral part of My Little Swans, and a valuable resource for the MLS members just as they have been for Katrina.</p>
<p>Ana Maria Pickens, one of luxury travel&#039;s foremost professionals, is working with Katrina to make My Little Swans the premier site for family travel resources.  As Executive Travel Counselor for American Express Centurion members, Ana Maria created custom itineraries for the most discerning travelers.  Now she brings her two decades of travel experience to the families of My Little Swans.</p>					
					</div>
				<div class="clear"></div>
				</div>
															<!---->
	
				<div class="tips_information_one tips_information_one_color">
					<div >

														tygygtyu<br />
												<p><img src="./uploads_user/1000/28/158_thumb.jpg" /><br /></p>					
					</div>
				<div class="clear"></div>
				</div>
										
			</div>
		</div>
						    
			
	
		<script>window.print();</script>

	';*/

convert_to_pdf("New");
?>