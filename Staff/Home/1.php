<!doctype html><html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="viewport" content="width=device-width"/>
        <meta name="theme-color" content="#000"/>
        <title>Grafana</title>
        <base href="/"/>
        <link rel="preload" href="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/fonts/roboto/RxZJdnzeo3R5zSexge8UUVtXRa8TVwTICgirnJhmVJw.woff2" as="font" crossorigin/>
        <link rel="icon" type="image/png" href="public/img/fav32.png"/><link rel="apple-touch-icon" sizes="180x180" href="public/img/apple-touch-icon.png"/>
        <link rel="mask-icon" href="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/img/grafana_mask_icon.svg" color="#F05A28"/>
        <link rel="stylesheet" href="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/grafana.dark.6c90b8800e5171d28a90.css"/>
        <script nonce="">performance.mark('frontend_boot_css_time_seconds');</script>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <meta name="msapplication-TileColor" content="#2b5797"/>
        <meta name="msapplication-config" content="public/img/browserconfig.xml"/>
    </head>
    <body class="theme-dark app-enterprise">
        <style>.preloader {
        height: 100%;
        flex-direction: column;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .preloader__enter {
        opacity: 0;
        animation-name: preloader-fade-in;
        animation-iteration-count: 1;
        animation-duration: 0.9s;
        animation-delay: 1.35s;
        animation-fill-mode: forwards;
      }

      .preloader__bounce {
        text-align: center;
        animation-name: preloader-bounce;
        animation-duration: 0.9s;
        animation-iteration-count: infinite;
      }

      .preloader__logo {
        display: inline-block;
        animation-name: preloader-squash;
        animation-duration: 0.9s;
        animation-iteration-count: infinite;
        width: 60px;
        height: 60px;
        background-repeat: no-repeat;
        background-size: contain;
        background-image: url('public/img/grafana_icon.svg');
      }

      .preloader__text {
        margin-top: 16px;
        font-weight: 500;
        font-size: 14px;
        font-family: Sans-serif;
        opacity: 0;
        animation-name: preloader-fade-in;
        animation-duration: 0.9s;
        animation-delay: 1.8s;
        animation-fill-mode: forwards;
      }

      .theme-light .preloader__text {
        color: #52545c;
      }

      .theme-dark .preloader__text {
        color: #d8d9da;
      }

      @keyframes preloader-fade-in {
        0% {
          opacity: 0;
           
          animation-timing-function: cubic-bezier(0, 0, 0.5, 1);
        }
        100% {
          opacity: 1;
        }
      }

      @keyframes preloader-bounce {
        from,
        to {
          transform: translateY(0px);
          animation-timing-function: cubic-bezier(0.3, 0, 0.1, 1);
        }
        50% {
          transform: translateY(-50px);
          animation-timing-function: cubic-bezier(0.9, 0, 0.7, 1);
        }
      }

      @keyframes preloader-squash {
        0% {
          transform: scaleX(1.3) scaleY(0.8);
          animation-timing-function: cubic-bezier(0.3, 0, 0.1, 1);
          transform-origin: bottom center;
        }
        15% {
          transform: scaleX(0.75) scaleY(1.25);
          animation-timing-function: cubic-bezier(0, 0, 0.7, 0.75);
          transform-origin: bottom center;
        }
        55% {
          transform: scaleX(1.05) scaleY(0.95);
          animation-timing-function: cubic-bezier(0.9, 0, 1, 1);
          transform-origin: top center;
        }
        95% {
          transform: scaleX(0.75) scaleY(1.25);
          animation-timing-function: cubic-bezier(0, 0, 0, 1);
          transform-origin: bottom center;
        }
        100% {
          transform: scaleX(1.3) scaleY(0.8);
          transform-origin: bottom center;
          animation-timing-function: cubic-bezier(0, 0, 0.7, 1);
        }
      }

       
      .preloader__text--fail {
        display: none;
      }

       
      .preloader--done .preloader__bounce,
      .preloader--done .preloader__logo {
        animation-name: none;
        display: none;
      }

      .preloader--done .preloader__logo,
      .preloader--done .preloader__text {
        display: none;
        color: #ff5705 !important;
        font-size: 15px;
      }

      .preloader--done .preloader__text--fail {
        display: block;
      }

      [ng\:cloak],
      [ng-cloak],
      .ng-cloak {
        display: none !important;
      }</style><div class="preloader"><div class="preloader__enter"><div class="preloader__bounce"><div class="preloader__logo"></div></div></div><div class="preloader__text">Loading Grafana</div><div class="preloader__text preloader__text--fail"><p><strong>If you're seeing this Grafana has failed to load its application files</strong><br/><br/></p><p>1. This could be caused by your reverse proxy settings.<br/><br/>2. If you host grafana under subpath make sure your grafana.ini root_url setting includes subpath. If not using a reverse proxy make sure to set serve_from_sub_path to true.<br/><br/>3. If you have a local dev build make sure you build frontend using: yarn start, yarn start:hot, or yarn build<br/><br/>4. Sometimes restarting grafana-server can help<br/><br/>5. Check if you are using a non-supported browser. For more information, refer to the list of <a href="https://grafana.com/docs/grafana/latest/installation/requirements/#supported-web-browsers">supported browsers</a>.</p></div><script nonce="">
        
        function checkBrowserCompatibility() {
          var isIE = navigator.userAgent.indexOf('MSIE') > -1;
          var isEdge = navigator.userAgent.indexOf('Edge/') > -1 || navigator.userAgent.indexOf('Edg/') > -1;
          var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
          var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

          

          var isEdgeVersion = /Edge\/([0-9.]+)/.exec(navigator.userAgent);

          if (isIE && parseFloat(/Trident\/([0-9.]+)/.exec(navigator.userAgent)[1]) <= 7) {
            return false;
          } else if (
            isEdge &&
            ((isEdgeVersion && parseFloat(isEdgeVersion[1]) <= 16) ||
              parseFloat(/Edg\/([0-9.]+)/.exec(navigator.userAgent)[1]) <= 16)
          ) {
            return false;
          } else if (isFirefox && parseFloat(/Firefox\/([0-9.]+)/.exec(navigator.userAgent)[1]) <= 64) {
            return false;
          } else if (isChrome && parseFloat(/Chrome\/([0-9.]+)/.exec(navigator.userAgent)[1]) <= 54) {
            return false;
          }

          return true;
        }

        if (!checkBrowserCompatibility()) {
          alert('Your browser is not fully supported, please try newer version.');
        }</script></div><div id="reactRoot"></div><script nonce="">window.grafanaBootData = {
        user: {"isSignedIn":false,"id":0,"externalUserId":"","login":"","email":"","name":"","lightTheme":false,"orgCount":0,"orgId":0,"orgName":"","orgRole":"","isGrafanaAdmin":false,"gravatarUrl":"","timezone":"browser","weekStart":"browser","locale":"en-US","helpFlags1":0,"hasEditPermissionInFolders":false},
        settings: {"alertingEnabled":false,"alertingErrorOrTimeout":"alerting","alertingMinInterval":60,"alertingNoDataOrNullValues":"no_data","allowOrgCreate":false,"angularSupportEnabled":true,"appSubUrl":"","appUrl":"https://lidyagnuramo.grafana.net/","applicationInsightsConnectionString":"","applicationInsightsEndpointUrl":"","authProxyEnabled":false,"autoAssignOrg":true,"awsAllowedAuthProviders":["keys"],"awsAssumeRoleEnabled":true,"azure":{"cloud":"AzureCloud","managedIdentityEnabled":false},"azureAuthEnabled":false,"buildInfo":{"buildstamp":1662657621,"commit":"e1f2f3c718","edition":"Pro","env":"production","hasUpdate":false,"hideVersion":false,"latestVersion":"","version":"9.1.3-e1f2f3c"},"caching":{"enabled":true},"dashboardPreviews":{"systemRequirements":{"met":false,"requiredImageRendererPluginVersion":""},"thumbnailsExist":false},"datasources":{"-- Dashboard --":{"type":"datasource","name":"-- Dashboard --","meta":{"id":"dashboard","type":"datasource","name":"-- Dashboard --","info":{"author":{"name":"","url":""},"description":"","links":null,"logos":{"small":"public/img/icn-datasource.svg","large":"public/img/icn-datasource.svg"},"build":{},"screenshots":null,"version":"","updated":""},"dependencies":{"grafanaDependency":"","grafanaVersion":"*","plugins":[]},"includes":null,"category":"","preload":false,"backend":false,"routes":null,"skipDataQuery":false,"autoEnabled":false,"annotations":false,"metrics":true,"alerting":false,"explore":false,"tables":false,"logs":false,"tracing":false,"builtIn":true,"streaming":false,"signature":"internal","module":"app/plugins/datasource/dashboard/module","baseUrl":"public/app/plugins/datasource/dashboard"},"isDefault":false,"preload":false,"jsonData":{}},"-- Grafana --":{"id":-1,"uid":"grafana","type":"datasource","name":"-- Grafana --","meta":{"id":"grafana","type":"datasource","name":"-- Grafana --","info":{"author":{"name":"","url":""},"description":"","links":null,"logos":{"small":"public/img/icn-datasource.svg","large":"public/img/icn-datasource.svg"},"build":{},"screenshots":null,"version":"","updated":""},"dependencies":{"grafanaDependency":"","grafanaVersion":"*","plugins":[]},"includes":null,"category":"","preload":false,"backend":true,"routes":null,"skipDataQuery":false,"autoEnabled":false,"annotations":true,"metrics":true,"alerting":false,"explore":false,"tables":false,"logs":false,"tracing":false,"builtIn":true,"streaming":false,"signature":"internal","module":"app/plugins/datasource/grafana/module","baseUrl":"public/app/plugins/datasource/grafana"},"isDefault":false,"preload":false,"jsonData":{}},"-- Mixed --":{"type":"datasource","name":"-- Mixed --","meta":{"id":"mixed","type":"datasource","name":"-- Mixed --","info":{"author":{"name":"","url":""},"description":"","links":null,"logos":{"small":"public/img/icn-datasource.svg","large":"public/img/icn-datasource.svg"},"build":{},"screenshots":null,"version":"","updated":""},"dependencies":{"grafanaDependency":"","grafanaVersion":"*","plugins":[]},"includes":null,"category":"","preload":false,"backend":false,"routes":null,"skipDataQuery":false,"autoEnabled":false,"annotations":false,"metrics":true,"alerting":false,"explore":false,"tables":false,"logs":false,"tracing":false,"queryOptions":{"minInterval":true},"builtIn":true,"mixed":true,"streaming":false,"signature":"internal","module":"app/plugins/datasource/mixed/module","baseUrl":"public/app/plugins/datasource/mixed"},"isDefault":false,"preload":false,"jsonData":{}}},"dateFormats":{"fullDate":"YYYY-MM-DD HH:mm:ss","useBrowserLocale":false,"interval":{"millisecond":"HH:mm:ss.SSS","second":"HH:mm:ss","minute":"HH:mm","hour":"MM/DD HH:mm","day":"MM/DD","month":"YYYY-MM","year":"YYYY"},"defaultTimezone":"browser","defaultWeekStart":"browser"},"defaultDatasource":"-- Grafana --","disableLoginForm":true,"disableSanitizeHtml":false,"disableUserSignUp":true,"editorsCanAdmin":false,"exploreEnabled":true,"expressionsEnabled":true,"externalUserMngInfo":"Users are managed via [grafana.com](https://grafana.com/orgs/lidyagnuramo/members). The table below shows users who have logged in at least once to this stack. To remove a user you also need to remove them from your [grafana.com](https://grafana.com/orgs/lidyagnuramo/members) org.","externalUserMngLinkName":"Manage users on grafana.com","externalUserMngLinkUrl":"https://grafana.com/orgs/lidyagnuramo/members","featureToggles":{"cloudMonitoringExperimentalUI":true,"cloudWatchDynamicLabels":true,"commandPalette":true,"database_metrics":true,"explore2Dashboard":true,"logRequestsInstrumentedAsUnknown":true,"lokiQueryBuilder":true,"migrationLocking":true,"promQueryBuilder":true,"publicDashboards":true,"swaggerUi":true,"tempoBackendSearch":true,"tempoSearch":true},"feedbackLinksEnabled":true,"googleAnalyticsId":"UA-58328364-6","grafanaJavascriptAgent":{"enabled":false,"customEndpoint":"","errorInstrumentalizationEnabled":false,"consoleInstrumentalizationEnabled":false,"webVitalsInstrumentalizationEnabled":false,"apiKey":""},"helpEnabled":true,"http2Enabled":false,"isPublicDashboardView":true,"jwtHeaderName":"","jwtUrlLogin":false,"ldapEnabled":false,"licenseInfo":{"appUrl":"https://lidyagnuramo.grafana.net/","edition":"Pro","enabledFeatures":{"accesscontrol":true,"accesscontrol.enforcement":true,"admin":true,"analytics":true,"analytics.writers":true,"auditing":true,"caching":true,"caching.api":true,"caching.queries":true,"caching.resources":true,"config.vault":true,"dspermissions":true,"dspermissions.enforcement":true,"encryption.aesgcm":true,"kms.encryption":true,"ldapdebug":true,"ldapsync":true,"provisioning":true,"recordedqueries":true,"reports":true,"reports.creation":true,"reports.email":true,"reports.pdf":true,"saml":true,"teamgroupsync":true,"teamsync":true,"userlimits":true,"whitelabeling":true},"expiry":1665257551,"licenseUrl":"https://grafana.com/products/enterprise/?utm_source=grafana_footer","stateInfo":"Licensed","trialExpiry":0},"licensing":{},"liveEnabled":true,"loginHint":"email or username","minRefreshInterval":"5s","panels":{"alertlist":{"id":"alertlist","name":"Alert list","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Shows list of alerts and their current status","links":null,"logos":{"small":"public/app/plugins/panel/alertlist/img/icn-singlestat-panel.svg","large":"public/app/plugins/panel/alertlist/img/icn-singlestat-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":15,"skipDataQuery":true,"state":"","baseUrl":"public/app/plugins/panel/alertlist","signature":"internal","module":"app/plugins/panel/alertlist/module"},"annolist":{"id":"annolist","name":"Annotations list","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"List annotations","links":null,"logos":{"small":"public/app/plugins/panel/annolist/img/icn-annolist-panel.svg","large":"public/app/plugins/panel/annolist/img/icn-annolist-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":true,"state":"","baseUrl":"public/app/plugins/panel/annolist","signature":"internal","module":"app/plugins/panel/annolist/module"},"barchart":{"id":"barchart","name":"Bar chart","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Categorical charts with group support","links":null,"logos":{"small":"public/app/plugins/panel/barchart/img/barchart.svg","large":"public/app/plugins/panel/barchart/img/barchart.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":2,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/barchart","signature":"internal","module":"app/plugins/panel/barchart/module"},"bargauge":{"id":"bargauge","name":"Bar gauge","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Horizontal and vertical gauges","links":null,"logos":{"small":"public/app/plugins/panel/bargauge/img/icon_bar_gauge.svg","large":"public/app/plugins/panel/bargauge/img/icon_bar_gauge.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":5,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/bargauge","signature":"internal","module":"app/plugins/panel/bargauge/module"},"candlestick":{"id":"candlestick","name":"Candlestick","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/candlestick/img/candlestick.svg","large":"public/app/plugins/panel/candlestick/img/candlestick.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/candlestick","signature":"internal","module":"app/plugins/panel/candlestick/module"},"cloud-home-discover":{"id":"cloud-home-discover","name":"cloud-home-discover","info":{"author":{"name":"","url":""},"description":"hosted grafana cloud home discover panel","links":[{"name":"Website","url":"https://github.com/grafana/grafana-starter-panel"},{"name":"License","url":"https://github.com/grafana/grafana-starter-panel/blob/master/LICENSE"}],"logos":{"small":"public/plugins/cloud-home-discover/img/logo.svg","large":"public/plugins/cloud-home-discover/img/logo.svg"},"build":{},"screenshots":[],"version":"v1.5.5","updated":"2022-08-25"},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/plugins/cloud-home-discover","signature":"valid","module":"plugins/cloud-home-discover/module"},"cloud-home-integrations":{"id":"cloud-home-integrations","name":"cloud-home-integrations","info":{"author":{"name":"","url":""},"description":"hosted grafana cloud home integrations panel","links":[{"name":"Website","url":"https://github.com/grafana/grafana-starter-panel"},{"name":"License","url":"https://github.com/grafana/grafana-starter-panel/blob/master/LICENSE"}],"logos":{"small":"public/plugins/cloud-home-integrations/img/logo.svg","large":"public/plugins/cloud-home-integrations/img/logo.svg"},"build":{},"screenshots":[],"version":"v1.5.5","updated":"2022-08-25"},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/plugins/cloud-home-integrations","signature":"valid","module":"plugins/cloud-home-integrations/module"},"cloud-home-links":{"id":"cloud-home-links","name":"cloud-home-links","info":{"author":{"name":"","url":""},"description":"hosted grafana cloud home links panel","links":[{"name":"Website","url":"https://github.com/grafana/grafana-starter-panel"},{"name":"License","url":"https://github.com/grafana/grafana-starter-panel/blob/master/LICENSE"}],"logos":{"small":"public/plugins/cloud-home-links/img/logo.svg","large":"public/plugins/cloud-home-links/img/logo.svg"},"build":{},"screenshots":[],"version":"v1.5.5","updated":"2022-08-25"},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/plugins/cloud-home-links","signature":"valid","module":"plugins/cloud-home-links/module"},"cloud-home-welcome":{"id":"cloud-home-welcome","name":"cloud-home-welcome","info":{"author":{"name":"","url":""},"description":"hosted grafana cloud home welcome panel","links":[{"name":"Website","url":"https://github.com/grafana/grafana-starter-panel"},{"name":"License","url":"https://github.com/grafana/grafana-starter-panel/blob/master/LICENSE"}],"logos":{"small":"public/plugins/cloud-home-welcome/img/logo.svg","large":"public/plugins/cloud-home-welcome/img/logo.svg"},"build":{},"screenshots":[],"version":"v1.5.5","updated":"2022-08-25"},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/plugins/cloud-home-welcome","signature":"valid","module":"plugins/cloud-home-welcome/module"},"dashlist":{"id":"dashlist","name":"Dashboard list","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"List of dynamic links to other dashboards","links":null,"logos":{"small":"public/app/plugins/panel/dashlist/img/icn-dashlist-panel.svg","large":"public/app/plugins/panel/dashlist/img/icn-dashlist-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":16,"skipDataQuery":true,"state":"","baseUrl":"public/app/plugins/panel/dashlist","signature":"internal","module":"app/plugins/panel/dashlist/module"},"gauge":{"id":"gauge","name":"Gauge","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Standard gauge visualization","links":null,"logos":{"small":"public/app/plugins/panel/gauge/img/icon_gauge.svg","large":"public/app/plugins/panel/gauge/img/icon_gauge.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":4,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/gauge","signature":"internal","module":"app/plugins/panel/gauge/module"},"geomap":{"id":"geomap","name":"Geomap","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Geomap panel","links":null,"logos":{"small":"public/app/plugins/panel/geomap/img/icn-geomap.svg","large":"public/app/plugins/panel/geomap/img/icn-geomap.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/geomap","signature":"internal","module":"app/plugins/panel/geomap/module"},"gettingstarted":{"id":"gettingstarted","name":"Getting Started","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/gettingstarted/img/icn-dashlist-panel.svg","large":"public/app/plugins/panel/gettingstarted/img/icn-dashlist-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":true,"sort":100,"skipDataQuery":true,"state":"","baseUrl":"public/app/plugins/panel/gettingstarted","signature":"internal","module":"app/plugins/panel/gettingstarted/module"},"grafana-worldmap-panel":{"id":"grafana-worldmap-panel","name":"Worldmap Panel","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"World Map panel for Grafana. Displays time series data or geohash data from Elasticsearch overlaid on a world map.","links":[{"name":"Project site","url":"https://github.com/grafana/worldmap-panel"},{"name":"MIT License","url":"https://github.com/grafana/worldmap-panel/blob/master/LICENSE"}],"logos":{"small":"public/plugins/grafana-worldmap-panel/images/worldmap_logo.svg","large":"public/plugins/grafana-worldmap-panel/images/worldmap_logo.svg"},"build":{"time":1589680271873,"repo":"git@github.com:grafana/worldmap-panel.git","branch":"v0.3.x","hash":"74af3ec645c42fed014b62900c008dfcec1657c2"},"screenshots":[{"name":"World","path":"public/plugins/grafana-worldmap-panel/images/worldmap-world.png"},{"name":"USA","path":"public/plugins/grafana-worldmap-panel/images/worldmap-usa.png"},{"name":"Light Theme","path":"public/plugins/grafana-worldmap-panel/images/worldmap-light-theme.png"}],"version":"0.3.2","updated":"Sun May 17 01:50:53 UTC 2020"},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/plugins/grafana-worldmap-panel","signature":"valid","module":"plugins/grafana-worldmap-panel/module"},"graph":{"id":"graph","name":"Graph (old)","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"The old default graph panel","links":null,"logos":{"small":"public/app/plugins/panel/graph/img/icn-graph-panel.svg","large":"public/app/plugins/panel/graph/img/icn-graph-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":13,"skipDataQuery":false,"state":"deprecated","baseUrl":"public/app/plugins/panel/graph","signature":"internal","module":"app/plugins/panel/graph/module"},"heatmap":{"id":"heatmap","name":"Heatmap","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Like a histogram over time","links":null,"logos":{"small":"public/app/plugins/panel/heatmap/img/icn-heatmap-panel.svg","large":"public/app/plugins/panel/heatmap/img/icn-heatmap-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":10,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/heatmap","signature":"internal","module":"app/plugins/panel/heatmap/module"},"heatmap-old":{"id":"heatmap-old","name":"Heatmap (legacy)","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Legacy heatmap panel based on angular, d3, and flot","links":[{"name":"Brendan Gregg - Heatmaps","url":"http://www.brendangregg.com/heatmaps.html"},{"name":"Brendan Gregg - Latency Heatmaps","url":" http://www.brendangregg.com/HeatMaps/latency.html"}],"logos":{"small":"public/app/plugins/panel/heatmap-old/img/icn-heatmap-panel.svg","large":"public/app/plugins/panel/heatmap-old/img/icn-heatmap-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"deprecated","baseUrl":"public/app/plugins/panel/heatmap-old","signature":"internal","module":"app/plugins/panel/heatmap-old/module"},"histogram":{"id":"histogram","name":"Histogram","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/histogram/img/histogram.svg","large":"public/app/plugins/panel/histogram/img/histogram.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":12,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/histogram","signature":"internal","module":"app/plugins/panel/histogram/module"},"logs":{"id":"logs","name":"Logs","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/logs/img/icn-logs-panel.svg","large":"public/app/plugins/panel/logs/img/icn-logs-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/logs","signature":"internal","module":"app/plugins/panel/logs/module"},"marcusolsson-treemap-panel":{"id":"marcusolsson-treemap-panel","name":"Treemap","info":{"author":{"name":"Marcus Olsson","url":"https://marcus.se.net"},"description":"Area-based visualization of hierarchical data","links":[{"name":"Website","url":"https://github.com/marcusolsson/grafana-treemap-panel"},{"name":"License","url":"https://github.com/marcusolsson/grafana-treemap-panel/blob/main/LICENSE"}],"logos":{"small":"public/plugins/marcusolsson-treemap-panel/img/logo.svg","large":"public/plugins/marcusolsson-treemap-panel/img/logo.svg"},"build":{},"screenshots":[{"name":"Treemap","path":"public/plugins/marcusolsson-treemap-panel/img/screenshot.png"}],"version":"0.9.3","updated":"2021-11-04"},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"","baseUrl":"public/plugins/grafanacloud-cardinality-management-app","signature":"valid","module":"plugins/grafanacloud-cardinality-management-app/community/marcusolsson-treemap-panel/module"},"news":{"id":"news","name":"News","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"RSS feed reader","links":null,"logos":{"small":"public/app/plugins/panel/news/img/news.svg","large":"public/app/plugins/panel/news/img/news.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":17,"skipDataQuery":true,"state":"beta","baseUrl":"public/app/plugins/panel/news","signature":"internal","module":"app/plugins/panel/news/module"},"nodeGraph":{"id":"nodeGraph","name":"Node Graph","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/nodeGraph/img/icn-node-graph.svg","large":"public/app/plugins/panel/nodeGraph/img/icn-node-graph.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/nodeGraph","signature":"internal","module":"app/plugins/panel/nodeGraph/module"},"piechart":{"id":"piechart","name":"Pie chart","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"The new core pie chart visualization","links":null,"logos":{"small":"public/app/plugins/panel/piechart/img/icon_piechart.svg","large":"public/app/plugins/panel/piechart/img/icon_piechart.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":8,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/piechart","signature":"internal","module":"app/plugins/panel/piechart/module"},"stat":{"id":"stat","name":"Stat","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Big stat values \u0026 sparklines","links":null,"logos":{"small":"public/app/plugins/panel/stat/img/icn-singlestat-panel.svg","large":"public/app/plugins/panel/stat/img/icn-singlestat-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":3,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/stat","signature":"internal","module":"app/plugins/panel/stat/module"},"state-timeline":{"id":"state-timeline","name":"State timeline","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"State changes and durations","links":null,"logos":{"small":"public/app/plugins/panel/state-timeline/img/timeline.svg","large":"public/app/plugins/panel/state-timeline/img/timeline.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":9,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/state-timeline","signature":"internal","module":"app/plugins/panel/state-timeline/module"},"status-history":{"id":"status-history","name":"Status history","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Periodic status history","links":null,"logos":{"small":"public/app/plugins/panel/status-history/img/status.svg","large":"public/app/plugins/panel/status-history/img/status.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":11,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/status-history","signature":"internal","module":"app/plugins/panel/status-history/module"},"table":{"id":"table","name":"Table","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Supports many column styles","links":null,"logos":{"small":"public/app/plugins/panel/table/img/icn-table-panel.svg","large":"public/app/plugins/panel/table/img/icn-table-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":6,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/table","signature":"internal","module":"app/plugins/panel/table/module"},"table-old":{"id":"table-old","name":"Table (old)","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Table Panel for Grafana","links":null,"logos":{"small":"public/app/plugins/panel/table-old/img/icn-table-panel.svg","large":"public/app/plugins/panel/table-old/img/icn-table-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"deprecated","baseUrl":"public/app/plugins/panel/table-old","signature":"internal","module":"app/plugins/panel/table-old/module"},"text":{"id":"text","name":"Text","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Supports markdown and html content","links":null,"logos":{"small":"public/app/plugins/panel/text/img/icn-text-panel.svg","large":"public/app/plugins/panel/text/img/icn-text-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":14,"skipDataQuery":true,"state":"","baseUrl":"public/app/plugins/panel/text","signature":"internal","module":"app/plugins/panel/text/module"},"timeseries":{"id":"timeseries","name":"Time series","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"Time based line, area and bar charts","links":null,"logos":{"small":"public/app/plugins/panel/timeseries/img/icn-timeseries-panel.svg","large":"public/app/plugins/panel/timeseries/img/icn-timeseries-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":1,"skipDataQuery":false,"state":"","baseUrl":"public/app/plugins/panel/timeseries","signature":"internal","module":"app/plugins/panel/timeseries/module"},"traces":{"id":"traces","name":"Traces","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/traces/img/traces-panel.svg","large":"public/app/plugins/panel/traces/img/traces-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":false,"sort":100,"skipDataQuery":false,"state":"beta","baseUrl":"public/app/plugins/panel/traces","signature":"internal","module":"app/plugins/panel/traces/module"},"welcome":{"id":"welcome","name":"Welcome","info":{"author":{"name":"Grafana Labs","url":"https://grafana.com"},"description":"","links":null,"logos":{"small":"public/app/plugins/panel/welcome/img/icn-dashlist-panel.svg","large":"public/app/plugins/panel/welcome/img/icn-dashlist-panel.svg"},"build":{},"screenshots":null,"version":"","updated":""},"hideFromList":true,"sort":100,"skipDataQuery":true,"state":"","baseUrl":"public/app/plugins/panel/welcome","signature":"internal","module":"app/plugins/panel/welcome/module"}},"passwordHint":"password","pluginAdminEnabled":true,"pluginAdminExternalManageEnabled":true,"pluginCatalogHiddenPlugins":[""],"pluginCatalogURL":"https://grafana.com/grafana/plugins/","pluginsToPreload":[{"path":"plugins/grafana-ml-app/module","version":"1.10.1"},{"path":"plugins/grafana-auth-app/module","version":"0.0.16"},{"path":"plugins/cloud-home-app/module","version":"v1.3.10"},{"path":"plugins/grafana-easystart-app/module","version":"v5.6.0"}],"profileEnabled":true,"queryHistoryEnabled":true,"rbacBuiltInRoleAssignmentEnabled":false,"rbacEnabled":true,"recordedQueries":{"enabled":true},"rendererAvailable":true,"rendererVersion":"3.4.1","reporting":{"enabled":true},"rudderstackConfigUrl":"https://rsc.grafana.com","rudderstackDataPlaneUrl":"https://rs.grafana.com","rudderstackSdkUrl":"https://rsdk.grafana.com","rudderstackWriteKey":"1vjCCxXFaLSCZL0JiIkR313ixXW","secretsManagerPluginEnabled":false,"sentry":{"enabled":true,"dsn":"","customEndpoint":"/log","sampleRate":1},"sigV4AuthEnabled":false,"unifiedAlerting":{"minInterval":"1m0s"},"unifiedAlertingEnabled":true,"verifyEmailEnabled":false,"viewersCanEdit":false,"whitelabeling":{"appTitle":"","links":[{"text":"Support","url":"https://grafana.com/orgs/602010#support","icon":"external-link-alt","blank":"_blank"}],"loadingLogo":"","loginBackground":"","loginBoxBackground":"","loginLogo":"","loginSubtitle":"","loginTitle":"Welcome to Grafana Cloud","menuLogo":""}},
        navTree: [{"id":"starred","text":"Starred","section":"core","icon":"star","sortWeight":-2000,"emptyMessageId":"starred-empty"},{"id":"dashboards","text":"Dashboards","section":"core","subTitle":"Manage dashboards and folders","icon":"apps","url":"/dashboards","sortWeight":-1800,"children":[{"id":"dashboards/browse","text":"Browse","icon":"sitemap","url":"/dashboards"},{"id":"dashboards/playlists","text":"Playlists","icon":"presentation-play","url":"/playlists"}]},{"id":"help","text":"Help","section":"config","subTitle":"Grafana v9.1.3-e1f2f3c (e1f2f3c718)","icon":"question-circle","url":"#","sortWeight":-1000}],
        themePaths: {
          light: 'https:\/\/grafana-assets.grafana.net\/grafana-pro\/9.1.3-e1f2f3c\/public/build/grafana.light.54fffb6dcf6204494323.css',
          dark: 'https:\/\/grafana-assets.grafana.net\/grafana-pro\/9.1.3-e1f2f3c\/public/build/grafana.dark.6c90b8800e5171d28a90.css'
        }
      };

      window.__grafana_load_failed = function() {
        var preloader = document.getElementsByClassName("preloader");
        if (preloader.length) {
          preloader[0].className = "preloader preloader--done";
        }
      }

      
      window.onload = function() {
        if (window.__grafana_app_bundle_loaded) {
          return;
        }
        window.__grafana_load_failed();
      };

      
        window.public_cdn_path = 'https:\/\/grafana-assets.grafana.net\/grafana-pro\/9.1.3-e1f2f3c\/public/build/';
      
      </script><script nonce="" src="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/runtime.99a959518bbaee646567.js"></script><script nonce="" src="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/8683.e8e950030315b5a81926.js"></script><script nonce="" src="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/2449.def35241a3dcae812382.js"></script><script nonce="" src="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/8893.aa83759dfd69659e4433.js"></script><script nonce="" src="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/2486.095bf9fec880b3ef01b4.js"></script><script nonce="" src="https://grafana-assets.grafana.net/grafana-pro/9.1.3-e1f2f3c/public/build/app.04327a12b80cac28c34f.js"></script><script nonce="">performance.mark('frontend_boot_js_done_time_seconds');</script></body></html>