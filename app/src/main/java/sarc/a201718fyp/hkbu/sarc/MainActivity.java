package sarc.a201718fyp.hkbu.sarc;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class MainActivity extends Activity {
    WebView myWebView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        String URL = "https://fypvm.problem.express:6143/FYP/";
        myWebView = (WebView) findViewById(R.id.webview);
        myWebView.setWebViewClient(new HelloWebViewClient());
        myWebView.getSettings().setJavaScriptEnabled(true);
        myWebView.getSettings().setLoadsImagesAutomatically(true);
        myWebView.getSettings().setAppCacheEnabled(false); // Disable while debugging
        myWebView.loadUrl(URL);

    }

    private class HelloWebViewClient extends WebViewClient {
        @Override
        public boolean shouldOverrideUrlLoading(final WebView view, final String url) {
            if (url.startsWith("tel:")) {
                Intent intent = new Intent(Intent.ACTION_DIAL, Uri.parse(url));
                startActivity(intent);
                return true;
            } else {
                view.loadUrl(url);
                return true;
            }
        }
    }

        @Override
        public void onBackPressed() {
            if (myWebView.canGoBack()) {
                myWebView.goBack();
            } else {
                super.onBackPressed();
            }
        }
    }

