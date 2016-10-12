
            $(document).ready(function() {

                // Initialize the plugin
                $('#ps3_monitor').popup({
                    transition: 'all 0.3s'
                });
              $('#poweroff').popup({
                    transition: 'all 0.3s'
                });
                $("#poweroff").html('Do you want to Shutdown the PS3 ?<br><br>');
                $("#poweroff").append('<button style="margin-top: 10px;margin-right: 30px; background: #CFE0F1" onclick="CallUrl(\'index.php?command=shutdown\')" class="poweroff_close">Yes</button>');
                $("#poweroff").append('<button style="margin-top: 10px; padding-right: 10px; padding-left: 10px; background: #CFE0F1" class="poweroff_close">No</button>');
                $('#reboot').popup({
                    transition: 'all 0.3s'
                });
                $("#reboot").html('Do you want to Reboot the PS3 ?<br><br>');
                $("#reboot").append('<button style="margin-top: 10px;margin-right: 30px; background: #CFE0F1" onclick="CallUrl(\'index.php?command=reboot\')" class="reboot_close">Yes</button>');
                $("#reboot").append('<button style="margin-top: 10px; padding-right: 10px; padding-left: 10px; background: #CFE0F1" class="reboot_close">No</button>');

                $('#unmount').popup({
                    transition: 'all 0.3s'
                });
                $("#unmount").html('Do you want to Unmount the current Game ?<br><br>');
                $("#unmount").append('<button style="margin-top: 10px;margin-right: 30px; background: #CFE0F1" onclick="CallUrl(\'index.php?command=unmount\')" class="unmount_close">Yes</button>');
                $("#unmount").append('<button style="margin-top: 10px; padding-right: 10px; padding-left: 10px; background: #CFE0F1" class="unmount_close">No</button>');
				
				
				 $('#game_details').popup({
                    transition: 'all 0.3s'
                });
				 $("#game_details").html('Loading data from server ...');
                 $("#game_details").load('game_description.php?id=%GAME_ID%');
							 
				 $('#alertrot').popup({
					transition: 'all 0.1s', opacity: 0.90
				});
				$("#alertrot").html('PS3 Games Manager v.0.42b is optimized<br>to work in <b>PORTRAIT MODE</b> only.<br>Please rotate your device back to it');
            });
