<?php
$Post = new Posts;
?>
<link href="../assets/extra-libs/horizontal-timeline/horizontal-timeline.css" rel="stylesheet" />
<style>
    .cd-horizontal-timeline .events a {
        position: absolute;
        bottom: 0;
        z-index: 2;
        text-align: center;
        font-size: 1rem;
        padding-bottom: 10px;
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        -o-transform: translateZ(0);
        transform: translateZ(0);
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor mb-0">Horizontal Timeline</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Horizontal Timeline</li>
        </ol>
    </div>
    <div class="col-md-7 col-12 align-self-center d-none d-md-block">
        <div class="d-flex mt-2 justify-content-end">
            <div class="d-flex me-3 ms-2">
                <div class="chart-text me-2">
                    <h6 class="mb-0"><small>THIS MONTH</small></h6>
                    <h4 class="mt-0 text-info">$58,356</h4>
                </div>
                <div class="spark-chart">
                    <div id="monthchart"></div>
                </div>
            </div>
            <div class="d-flex ms-2">
                <div class="chart-text me-2">
                    <h6 class="mb-0"><small>LAST MONTH</small></h6>
                    <h4 class="mt-0 text-primary">$48,356</h4>
                </div>
                <div class="spark-chart">
                    <div id="lastmonthchart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- -------------------------------------------------------------- -->
<!-- Container fluid  -->
<!-- -------------------------------------------------------------- -->
<div class="container-fluid">
    <!-- -------------------------------------------------------------- -->
    <!-- Start Page Content -->
    <!-- -------------------------------------------------------------- -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="cd-horizontal-timeline">
                        <div class="timeline">
                            <div class="events-wrapper">
                                <div class="events">
                                    <ol>
                                        <?php
                                        $loop_timeline = $Post->timeline();
                                        $last_date = "";
                                        $count_first = 1;
                                        foreach ($loop_timeline as $rowPost) {
                                            $selected = $count_first == 1 ? 'class="selected"' : '';
                                            $post_date =  date("d/m/Y", strtotime($rowPost['post_date']));
                                            if ($last_date != $post_date) {
                                                echo '<li>
                                                   <a href="#0" data-date="' . $post_date . '" ' . $selected . '>' . date("d M", strtotime($rowPost['post_date'])) . '</a>
                                               </li>';
                                            }
                                            $last_date = $post_date;
                                            $count_first++;
                                        }
                                        ?>
                                    </ol>
                                    <span class="filling-line" aria-hidden="true"></span>
                                </div>
                                <!-- .events -->
                            </div>
                            <!-- .events-wrapper -->
                            <ul class="cd-timeline-navigation">
                                <li><a href="#0" class="prev inactive">Prev</a></li>
                                <li><a href="#0" class="next">Next</a></li>
                            </ul>
                            <!-- .cd-timeline-navigation -->
                        </div>
                        <!-- .timeline -->
                        <div class="events-content">
                            <ol>
                                <?php
                                $last_date = "";
                                $count_first = 1;
                                foreach ($loop_timeline as $rowPost) {
                                    $selected = $count_first == 1 ? 'class="selected"' : '';
                                    $post_date =  date("d/m/Y", strtotime($rowPost['post_date']));
                                    if ($last_date != $post_date) {
                                ?>
                                        <li <?= $selected ?> data-date="<?= $post_date ?>">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <img class="img-circle pull-left me-3 mb-2" height="60" width="60" alt="user" src="../assets/images/users/default-user.jpeg" />
                                                </div>
                                                <div>
                                                    <h2><?= $rowPost['post_title'] ?></h2>
                                                    <h6><?= date("F d,Y", strtotime($rowPost['post_date'])); ?></h6>
                                                </div>
                                            </div>
                                            <p class="pt-3"><?= $rowPost['post_content'] ?></p>
                                            <p>
                                                <button class="btn btn-rounded btn-outline-info mt-3">
                                                    Read more
                                                </button>
                                            </p>
                                        <?php } else { ?>
                                            <div class="d-flex align-items-center mt-5">
                                                <div>
                                                    <img class="img-circle pull-left me-3 mb-2" height="60" width="60" alt="user" src="../assets/images/users/default-user.jpeg" />
                                                </div>
                                                <div>
                                                    <h2><?= $rowPost['post_title'] ?></h2>
                                                    <h6><?= date("F d,Y", strtotime($rowPost['post_date'])); ?></h6>
                                                </div>
                                            </div>
                                            <p class="pt-3"><?= $rowPost['post_content'] ?></p>
                                            <p>
                                                <button class="btn btn-rounded btn-outline-info mt-3">
                                                    Read more
                                                </button>
                                            </p>
                                    <?php }
                                    $last_date = $post_date;
                                    $count_first++;
                                }
                                    ?>
                            </ol>
                        </div>
                        <!-- .events-content -->
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->
</div>

<script>
    jQuery(document).ready(function($) {
        var timelines = $(".cd-horizontal-timeline"),
            eventsMinDistance = 60;

        timelines.length > 0 && initTimeline(timelines);

        function initTimeline(timelines) {
            timelines.each(function() {
                var timeline = $(this),
                    timelineComponents = {};
                //cache timeline components
                timelineComponents["timelineWrapper"] = timeline.find(".events-wrapper");
                timelineComponents["eventsWrapper"] =
                    timelineComponents["timelineWrapper"].children(".events");
                timelineComponents["fillingLine"] =
                    timelineComponents["eventsWrapper"].children(".filling-line");
                timelineComponents["timelineEvents"] =
                    timelineComponents["eventsWrapper"].find("a");
                timelineComponents["timelineDates"] = parseDate(
                    timelineComponents["timelineEvents"]
                );
                timelineComponents["eventsMinLapse"] = minLapse(
                    timelineComponents["timelineDates"]
                );
                timelineComponents["timelineNavigation"] = timeline.find(
                    ".cd-timeline-navigation"
                );
                timelineComponents["eventsContent"] =
                    timeline.children(".events-content");

                //assign a left postion to the single events along the timeline
                setDatePosition(timelineComponents, eventsMinDistance);
                //assign a width to the timeline
                var timelineTotWidth = setTimelineWidth(
                    timelineComponents,
                    eventsMinDistance
                );
                //the timeline has been initialize - show it
                timeline.addClass("loaded");

                //detect click on the next arrow
                timelineComponents["timelineNavigation"].on(
                    "click",
                    ".next",
                    function(event) {
                        event.preventDefault();
                        updateSlide(timelineComponents, timelineTotWidth, "next");
                    }
                );
                //detect click on the prev arrow
                timelineComponents["timelineNavigation"].on(
                    "click",
                    ".prev",
                    function(event) {
                        event.preventDefault();
                        updateSlide(timelineComponents, timelineTotWidth, "prev");
                    }
                );
                //detect click on the a single event - show new event content
                timelineComponents["eventsWrapper"].on("click", "a", function(event) {
                    event.preventDefault();
                    timelineComponents["timelineEvents"].removeClass("selected");
                    $(this).addClass("selected");
                    updateOlderEvents($(this));
                    updateFilling(
                        $(this),
                        timelineComponents["fillingLine"],
                        timelineTotWidth
                    );
                    updateVisibleContent($(this), timelineComponents["eventsContent"]);
                });

                //on swipe, show next/prev event content
                timelineComponents["eventsContent"].on("swipeleft", function() {
                    var mq = checkMQ();
                    mq == "mobile" &&
                        showNewContent(timelineComponents, timelineTotWidth, "next");
                });
                timelineComponents["eventsContent"].on("swiperight", function() {
                    var mq = checkMQ();
                    mq == "mobile" &&
                        showNewContent(timelineComponents, timelineTotWidth, "prev");
                });

                //keyboard navigation
                $(document).keyup(function(event) {
                    if (event.which == "37" && elementInViewport(timeline.get(0))) {
                        showNewContent(timelineComponents, timelineTotWidth, "prev");
                    } else if (event.which == "39" && elementInViewport(timeline.get(0))) {
                        showNewContent(timelineComponents, timelineTotWidth, "next");
                    }
                });
            });
        }

        function updateSlide(timelineComponents, timelineTotWidth, string) {
            //retrieve translateX value of timelineComponents['eventsWrapper']
            var translateValue = getTranslateValue(timelineComponents["eventsWrapper"]),
                wrapperWidth = Number(
                    timelineComponents["timelineWrapper"].css("width").replace("px", "")
                );
            //translate the timeline to the left('next')/right('prev')
            string == "next" ?
                translateTimeline(
                    timelineComponents,
                    translateValue - wrapperWidth + eventsMinDistance,
                    wrapperWidth - timelineTotWidth
                ) :
                translateTimeline(
                    timelineComponents,
                    translateValue + wrapperWidth - eventsMinDistance
                );
        }

        function showNewContent(timelineComponents, timelineTotWidth, string) {
            //go from one event to the next/previous one
            var visibleContent = timelineComponents["eventsContent"].find(".selected"),
                newContent =
                string == "next" ? visibleContent.next() : visibleContent.prev();

            if (newContent.length > 0) {
                //if there's a next/prev event - show it
                var selectedDate = timelineComponents["eventsWrapper"].find(".selected"),
                    newEvent =
                    string == "next" ?
                    selectedDate.parent("li").next("li").children("a") :
                    selectedDate.parent("li").prev("li").children("a");

                updateFilling(
                    newEvent,
                    timelineComponents["fillingLine"],
                    timelineTotWidth
                );
                updateVisibleContent(newEvent, timelineComponents["eventsContent"]);
                newEvent.addClass("selected");
                selectedDate.removeClass("selected");
                updateOlderEvents(newEvent);
                updateTimelinePosition(string, newEvent, timelineComponents);
            }
        }

        function updateTimelinePosition(string, event, timelineComponents) {
            //translate timeline to the left/right according to the position of the selected event
            var eventStyle = window.getComputedStyle(event.get(0), null),
                eventLeft = Number(eventStyle.getPropertyValue("left").replace("px", "")),
                timelineWidth = Number(
                    timelineComponents["timelineWrapper"].css("width").replace("px", "")
                ),
                timelineTotWidth = Number(
                    timelineComponents["eventsWrapper"].css("width").replace("px", "")
                );
            var timelineTranslate = getTranslateValue(
                timelineComponents["eventsWrapper"]
            );

            if (
                (string == "next" && eventLeft > timelineWidth - timelineTranslate) ||
                (string == "prev" && eventLeft < -timelineTranslate)
            ) {
                translateTimeline(
                    timelineComponents,
                    -eventLeft + timelineWidth / 2,
                    timelineWidth - timelineTotWidth
                );
            }
        }

        function translateTimeline(timelineComponents, value, totWidth) {
            var eventsWrapper = timelineComponents["eventsWrapper"].get(0);
            value = value > 0 ? 0 : value; //only negative translate value
            value = !(typeof totWidth === "undefined") && value < totWidth ? totWidth : value; //do not translate more than timeline width
            setTransformValue(eventsWrapper, "translateX", value + "px");
            //update navigation arrows visibility
            value == 0 ?
                timelineComponents["timelineNavigation"]
                .find(".prev")
                .addClass("inactive") :
                timelineComponents["timelineNavigation"]
                .find(".prev")
                .removeClass("inactive");
            value == totWidth ?
                timelineComponents["timelineNavigation"]
                .find(".next")
                .addClass("inactive") :
                timelineComponents["timelineNavigation"]
                .find(".next")
                .removeClass("inactive");
        }

        function updateFilling(selectedEvent, filling, totWidth) {
            //change .filling-line length according to the selected event
            var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
                eventLeft = eventStyle.getPropertyValue("left"),
                eventWidth = eventStyle.getPropertyValue("width");
            eventLeft =
                Number(eventLeft.replace("px", "")) +
                Number(eventWidth.replace("px", "")) / 2;
            var scaleValue = eventLeft / totWidth;
            setTransformValue(filling.get(0), "scaleX", scaleValue);
        }

        function setDatePosition(timelineComponents, min) {
            for (i = 0; i < timelineComponents["timelineDates"].length; i++) {
                var distance = daydiff(
                        timelineComponents["timelineDates"][0],
                        timelineComponents["timelineDates"][i]
                    ),
                    distanceNorm =
                    Math.round(distance / timelineComponents["eventsMinLapse"]) + 2;
                timelineComponents["timelineEvents"]
                    .eq(i)
                    .css("left", distanceNorm * min + "px");
            }
        }

        function setTimelineWidth(timelineComponents, width) {
            var timeSpan = daydiff(
                    timelineComponents["timelineDates"][0],
                    timelineComponents["timelineDates"][
                        timelineComponents["timelineDates"].length - 1
                    ]
                ),
                timeSpanNorm = timeSpan / timelineComponents["eventsMinLapse"],
                timeSpanNorm = Math.round(timeSpanNorm) + 4,
                totalWidth = timeSpanNorm * width;
            timelineComponents["eventsWrapper"].css("width", totalWidth + "px");
            updateFilling(
                timelineComponents["eventsWrapper"].find("a.selected"),
                timelineComponents["fillingLine"],
                totalWidth
            );
            updateTimelinePosition(
                "next",
                timelineComponents["eventsWrapper"].find("a.selected"),
                timelineComponents
            );

            return totalWidth;
        }

        function updateVisibleContent(event, eventsContent) {
            var eventDate = event.data("date"),
                visibleContent = eventsContent.find(".selected"),
                selectedContent = eventsContent.find('[data-date="' + eventDate + '"]'),
                selectedContentHeight = selectedContent.height();

            if (selectedContent.index() > visibleContent.index()) {
                var classEnetering = "selected enter-right",
                    classLeaving = "leave-left";
            } else {
                var classEnetering = "selected enter-left",
                    classLeaving = "leave-right";
            }

            selectedContent.attr("class", classEnetering);
            visibleContent
                .attr("class", classLeaving)
                .one(
                    "webkitAnimationEnd oanimationend msAnimationEnd animationend",
                    function() {
                        visibleContent.removeClass("leave-right leave-left");
                        selectedContent.removeClass("enter-left enter-right");
                    }
                );
            eventsContent.css("height", selectedContentHeight + "px");
        }

        function updateOlderEvents(event) {
            event
                .parent("li")
                .prevAll("li")
                .children("a")
                .addClass("older-event")
                .end()
                .end()
                .nextAll("li")
                .children("a")
                .removeClass("older-event");
        }

        function getTranslateValue(timeline) {
            var timelineStyle = window.getComputedStyle(timeline.get(0), null),
                timelineTranslate =
                timelineStyle.getPropertyValue("-webkit-transform") ||
                timelineStyle.getPropertyValue("-moz-transform") ||
                timelineStyle.getPropertyValue("-ms-transform") ||
                timelineStyle.getPropertyValue("-o-transform") ||
                timelineStyle.getPropertyValue("transform");

            if (timelineTranslate.indexOf("(") >= 0) {
                var timelineTranslate = timelineTranslate.split("(")[1];
                timelineTranslate = timelineTranslate.split(")")[0];
                timelineTranslate = timelineTranslate.split(",");
                var translateValue = timelineTranslate[4];
            } else {
                var translateValue = 0;
            }

            return Number(translateValue);
        }

        function setTransformValue(element, property, value) {
            element.style["-webkit-transform"] = property + "(" + value + ")";
            element.style["-moz-transform"] = property + "(" + value + ")";
            element.style["-ms-transform"] = property + "(" + value + ")";
            element.style["-o-transform"] = property + "(" + value + ")";
            element.style["transform"] = property + "(" + value + ")";
        }

        //based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
        function parseDate(events) {
            var dateArrays = [];
            events.each(function() {
                var singleDate = $(this),
                    dateComp = singleDate.data("date").split("T");
                if (dateComp.length > 1) {
                    //both DD/MM/YEAR and time are provided
                    var dayComp = dateComp[0].split("/"),
                        timeComp = dateComp[1].split(":");
                } else if (dateComp[0].indexOf(":") >= 0) {
                    //only time is provide
                    var dayComp = ["2000", "0", "0"],
                        timeComp = dateComp[0].split(":");
                } else {
                    //only DD/MM/YEAR
                    var dayComp = dateComp[0].split("/"),
                        timeComp = ["0", "0"];
                }
                var newDate = new Date(
                    dayComp[2],
                    dayComp[1] - 1,
                    dayComp[0],
                    timeComp[0],
                    timeComp[1]
                );
                dateArrays.push(newDate);
            });
            return dateArrays;
        }

        function daydiff(first, second) {
            return Math.round(second - first);
        }

        function minLapse(dates) {
            //determine the minimum distance among events
            var dateDistances = [];
            for (i = 1; i < dates.length; i++) {
                var distance = daydiff(dates[i - 1], dates[i]);
                dateDistances.push(distance);
            }
            return Math.min.apply(null, dateDistances);
        }

        /*
		How to tell if a DOM element is visible in the current viewport?
		http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
	*/
        function elementInViewport(el) {
            var top = el.offsetTop;
            var left = el.offsetLeft;
            var width = el.offsetWidth;
            var height = el.offsetHeight;

            while (el.offsetParent) {
                el = el.offsetParent;
                top += el.offsetTop;
                left += el.offsetLeft;
            }

            return (
                top < window.pageYOffset + window.innerHeight &&
                left < window.pageXOffset + window.innerWidth &&
                top + height > window.pageYOffset &&
                left + width > window.pageXOffset
            );
        }

        function checkMQ() {
            //check if mobile or desktop device
            return window
                .getComputedStyle(
                    document.querySelector(".cd-horizontal-timeline"),
                    "::before"
                )
                .getPropertyValue("content")
                .replace(/'/g, "")
                .replace(/"/g, "");
        }
    });
</script>