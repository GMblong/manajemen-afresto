<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_LiveBroadcast;
use Google_Service_YouTube_LiveStream;
use Google_Service_YouTube_LiveBroadcastSnippet;
use Google_Service_YouTube_LiveBroadcastStatus;
use Google_Service_YouTube_LiveStreamSnippet;
use Google_Service_YouTube_CdnSettings;
use Google_Service_YouTube_LiveBroadcastContentDetails;
use Google_Service_YouTube_MonitorStream;

class YouTubeLiveStreamingController extends Controller
{
    public function startLiveStream()
    {
        $client = new Google_Client();
        $client->setApplicationName('afresto');
        $client->setDeveloperKey(env('YOUTUBE_API_KEY')); // Ganti dengan nama kunci API YouTube Anda dari .env

        $youtube = new Google_Service_YouTube($client);

        $broadcast = new Google_Service_YouTube_LiveBroadcast();
        $broadcastSnippet = new Google_Service_YouTube_LiveBroadcastSnippet();
        $broadcastSnippet->setTitle('My Live Stream');
        $broadcast->setSnippet($broadcastSnippet);
        $broadcast->setStatus(new Google_Service_YouTube_LiveBroadcastStatus(['privacyStatus' => 'public']));

        $broadcast = $youtube->liveBroadcasts->insert('snippet,status', $broadcast);

        $stream = new Google_Service_YouTube_LiveStream();
        $streamSnippet = new Google_Service_YouTube_LiveStreamSnippet();
        $streamSnippet->setTitle('My Stream');
        $stream->setSnippet($streamSnippet);
        $cdnSettings = new Google_Service_YouTube_CdnSettings(['format' => '1080p', 'ingestionType' => 'rtmp']);
        $stream->setCdn($cdnSettings);

        $stream = $youtube->liveStreams->insert('snippet,cdn', $stream);

        $bind = new Google_Service_YouTube_LiveBroadcastContentDetails();
        $monitorStream = new Google_Service_YouTube_MonitorStream();
        $monitorStream->setEnableMonitorStream(false);
        $bind->setMonitorStream($monitorStream);
        $bind->setEnableEmbed(true);
        $bind->setEnableDvr(true);
        $bind->setEnableContentEncryption(true);
        $bind->setRecordFromStart(true);
        $bind->setEnableClosedCaptions(false);
        $bind->setEnableLowLatency(true);
        $bind->setProjection('rectangular');
        $bind->setStream($stream->getId());

        $broadcast->setContentDetails($bind);
        $youtube->liveBroadcasts->update('snippet,contentDetails,status', $broadcast->getId(), $broadcast);

        return redirect()->back()->with('success', 'Live stream started!');
    }
}
