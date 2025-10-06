<section class="wrap-fortuneWheel">
    <div class="container py-xl-5 py-lg-5 py-md-5 py-3">
        <div class="card bg-transparent">
            
            <dl class="row m-0">
                <dd class="col-xl-7 col-lg-7 col-md-7 col-12 m-0">
                    <canvas id="fortuneWheel" width="500" height="500">
                        <p class="text-white text-center">Sorry, your browser doesn't support canvas. Please try another.</p>
                    </canvas>
                    <div class="text-center">
                        <a href="javascript:void(0);" class="btn-spin rounded text-uppercase box-shadow" onClick="calculatePrize();"><?=lang('Nav.spin');?></a>
                    </div>
                </dd>
                <dd class="col-xl-5 col-lg-5 col-md-5 col-12 m-0">
                    <article class="topList overflow-hidden rounded box-shadow">
                        <table class="table table-sm table-dark table-hover">
                        <thead class="text-center"><tr><th><?=lang('Label.player');?></th><th><?=lang('Label.prize');?></th></tr></thead>
                        <tbody class="text-center" id="topList"></tbody>
                        </table>
                    </article>

                    <article class="agenda">
                        <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="420" src="https://spg20.vvip55.com/prizelist.html"></iframe>
                    </article>
                </dd>
            </dl>
        
        </div>
    </div>
</section>

<script src="<?=base_url('assets/vendors/fortunewheel/Winwheel.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/fortunewheel/TweenMax.min.js');?>"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    topList();
});

function topList()
{
    $.get('/fortune-wheel/top-20', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            let list = obj.data;
            list.forEach(function(item, index) {
                var node = document.createElement("tr");
                var nodeName = document.createElement("td");
                var nodePrize = document.createElement("td");

                var nodeNameText = document.createTextNode(item.loginId);
                
                if( item.rewardsAmount==0 ) {
                    var nodePrizeText = document.createTextNode(item.displayName.EN);
                } else {
                    var nodePrizeText = document.createTextNode(item.rewardsAmount);
                }

                nodeName.appendChild(nodeNameText);
                nodePrize.appendChild(nodePrizeText);
                node.appendChild(nodeName);
                node.appendChild(nodePrize);
                document.getElementById('topList').appendChild(node);
            });
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

let segment, theWheel, ctx;
$.get('/fortune-wheel/get', function(data, status) {
    const obj = JSON.parse(data);
    if( obj.code==1 && obj.data!='' ) {
        segment = obj.data.length;
        var wheel = obj.data;
        var arr = [];

        let canvas = document.getElementById('fortuneWheel');
        let ctx = canvas.getContext('2d');
        let canvasCenter = canvas.height / 2;
        let yellowGradient = ctx.createRadialGradient(canvasCenter, canvasCenter, 50, canvasCenter, canvasCenter, 250);
        yellowGradient.addColorStop(0, "#FCF6C4");
        yellowGradient.addColorStop(0.5, "#FCF6C4");
        yellowGradient.addColorStop(1, "#FCF6C4");

        let redGradient = ctx.createRadialGradient(canvasCenter, canvasCenter, 50, canvasCenter, canvasCenter, 250);
        redGradient.addColorStop(0, "#E54439");
        redGradient.addColorStop(0.5, "#E2382F");
        redGradient.addColorStop(1, "#FF0000");

        let purpleGradient = ctx.createRadialGradient(canvasCenter, canvasCenter, 50, canvasCenter, canvasCenter, 250);
        purpleGradient.addColorStop(0, "#cb60b3");
        purpleGradient.addColorStop(0.5, "#ad1283");
        purpleGradient.addColorStop(1, "#de47ac");

        var bgColor = [yellowGradient,redGradient,purpleGradient,yellowGradient,redGradient,purpleGradient];
        var textColor = ['#000','#FFF','#FFF','#000','#FFF','#FFF'];
        wheel.forEach(function(item, index) {
            var oj = {};
            // oj['image'] = '<?//=base_url('assets/vendors/fortunewheel/img/jane.png');?>';
            oj['fillStyle'] = bgColor[index];
            oj['textFillStyle'] = textColor[index];
            oj['text'] = item.displayName.EN.toUpperCase();
            arr.push(oj);
        });

        theWheel = new Winwheel({
            'canvasId': 'fortuneWheel',
            'numSegments': segment,
            'outerRadius': 200,
            'drawText': true,
            // 'fillStyle': redGradient,
            'textFontSize': 18,
            'textFontWeight': 'bold',
            'textOrientation': 'horizontal',
            'textAlignment': 'inner',
            'textDirection': 'reversed',
            'textMargin': 30,
            'textFontFamily': 'Verdana',
            // 'textStrokeStyle': '#FFF',
            // 'textLineWidth': 1,
            // 'textFillStyle': 'white',
            //'drawMode': 'segmentImage',    // Must be segmentImage to draw wheel using one image per segemnt.
            'segments': arr,
            'animation':
            {
                'type': 'spinToStop',
                'duration': 5,
                'spins': segment+3,
                'callbackAfter': 'drawTriangle()',
                'callbackFinished': alertPrize,
                'callbackSound': playSound,
                'soundTrigger': 'pin'
            },
            'pins':
            {
                'number': segment+3,
                'fillStyle': '#FDF5A6',
                'outerRadius': 5,
            }
        });

         
    } else if( obj.code==1 && obj.data=='' ) {
        swal.fire({
            title: 'Nothing to Spin Now',
            icon: 'info',
        }).then((result) => {
            $('.btn-spin').hide();
        });
    } else {
        swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
    }
})
.done(function() {
})
.fail(function() {
    swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
});

let audio = new Audio('<?=base_url('assets/vendors/fortunewheel/tick.mp3');?>');
let winning = new Audio('<?=base_url('assets/vendors/fortunewheel/winning.mp3');?>');

function playSound()
{
    // Stop and rewind the sound if it already happens to be playing.
    audio.pause();
    audio.currentTime = 0;

    // Play the sound.
    audio.play();
    return;
}

let wheelPower = 0;
let wheelSpinning = false;

function powerSelected(powerLevel)
{
    // Ensure that power can't be changed while wheel is spinning.
    if (wheelSpinning == false) {
        // Reset all to grey incase this is not the first time the user has selected the power.
        document.getElementById('pw1').className = "";
        document.getElementById('pw2').className = "";
        document.getElementById('pw3').className = "";

        // Now light up all cells below-and-including the one selected by changing the class.
        if (powerLevel >= 1) {
            document.getElementById('pw1').className = "pw1";
        }

        if (powerLevel >= 2) {
            document.getElementById('pw2').className = "pw2";
        }

        if (powerLevel >= 3) {
            document.getElementById('pw3').className = "pw3";
        }

        // Set wheelPower var used when spin button is clicked.
        wheelPower = powerLevel;

        // Light up the spin button by changing it's source image and adding a clickable class to it.
        document.getElementById('spin_button').src = "<?=base_url('assets/vendors/fortunewheel/img/spin_on.png');?>";
        document.getElementById('spin_button').className = "clickable";
    }
}

function startSpin()
{
    // Ensure that spinning can't be clicked again while already running.
    if (wheelSpinning == false) {
        // Based on the power level selected adjust the number of spins for the wheel, the more times is has
        // to rotate with the duration of the animation the quicker the wheel spins.
        if (wheelPower == 1) {
            theWheel.animation.spins = 3;
        } else if (wheelPower == 2) {
            theWheel.animation.spins = 8;
        } else if (wheelPower == 3) {
            theWheel.animation.spins = 15;
        }

        // Disable the spin button so can't click again while wheel is spinning.
        document.getElementById('spin_button').src = "<?=base_url('assets/vendors/fortunewheel/img/spin_off.png');?>";
        document.getElementById('spin_button').className = "";

        // Begin the spin animation by calling startAnimation on the wheel object.
        theWheel.startAnimation();

        // Set to true so that power can't be changed and spin button re-enabled during
        // the current animation. The user will have to reset before spinning again.
        wheelSpinning = true;
        return;
    }
}

function calculatePrize()
{
    theWheel.animation.spins = 15;
    $.get('/fortune-wheel/spin', function(data, status) {
        const obj = JSON.parse(data);
        StopAtPrize(obj.data.id,obj.data.name);
    })
    .done(function() {
        refreshBalance();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    }); 
}

function StopAtPrize(id,name)
{
    $.get('/fortune-wheel/get', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            const loopWheel = obj.data;
            loopWheel.forEach(function(item, index) {
                if( id==item.id ) {
                    var segmentNumber = index+1;
                    var stopAt = theWheel.getRandomForSegment(segmentNumber);
                    theWheel.animation.stopAngle = stopAt;
                    theWheel.startAnimation();
                    wheelSpinning = true;
                    return;
                }
            });
        } else {
            alert('something Wrong');
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    }); 
}

function resetWheel()
{
    theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
    theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
    theWheel.draw();                // Call draw to render changes to the wheel.

    document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
    document.getElementById('pw2').className = "";
    document.getElementById('pw3').className = "";

    wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
}

function alertPrize(indicatedSegment)
{
    // Do basic alert of the segment text. You would probably want to do something more interesting with this information.
    // alert(indicatedSegment.text + ' says Hi');
    // resetWheel();
    document.getElementById('topList').innerHTML = '';
    topList();

    winning.pause();
    winning.currentTime = 0;

    // Play the sound.
    winning.play();
    // return;

    swal.fire("Congratulation!", "You have got the prize", "success").then(() => {
        resetWheel();
        return;
    });
}

drawTriangle();

function drawTriangle()
{
    ctx = theWheel.ctx;
    ctx.strokeStyle = '#fccd4d';
    ctx.fillStyle = '#fccd4d';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(220, 5);
    ctx.lineTo(280, 5);
    ctx.lineTo(250, 40);
    ctx.lineTo(221, 5);
    ctx.stroke();
    ctx.fill();
}
</script>