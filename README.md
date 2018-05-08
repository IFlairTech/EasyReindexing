IFlair Reindexing
===
Beneficial for non-technical person to refresh the indexes in single click.

<p>Are you non-technical person tired of refreshing indexes or looking to refresh indexes anywhere on admin? Then <u>IFlair_Reindexing</u> will help you to refresh the indexes of Magento in single click. IFlair_Reindexing provides flexible and easy way to refresh the indexes for your Magento store though you are non-technical person.</p><br />

<h3>IFlair Reindexing will:</h3>
<ol>
<li>Allow you to refresh indexes in single click.</li>
<li>Avoid to run commands to refresh indexes.</li>
</ol><br />

<h3>IFlair Reindexing Extension:</h3>
<ol>
<li>Based on default magento admin interface</li>
<li>A must-have extension for non-technical person</li>
<li>Easy to install and use</li>
<li>Don’t affect Magento core files</li>
<li>100% opensource</li>
</ol><br />

<p><u>IFlair Reindexing</u> is really convenient extension to refresh any kind of built in indexes in Magento. The process is simplified with this plugin which is beneficial for non-technical person to refresh the indexes on their website in single click. Users just have to click on icon available on the right hand side in header and that’s it, all indexes are refreshed.</p>

<h2>Composer Installation Instructions</h2>
Configure composer to search for new repository
<pre>
composer config repositories.IFlairTech/EasyReindexing vcs https://github.com/IFlairTech/EasyReindexing
</pre>
Then, install module as below:
<pre>  
  composer require iflair/reindexing
</pre>
Then, enable module and install in Magento:
<pre>
php bin/magento setup:di:compile
php bin/magento module:enable IFlair_Reindexing
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
</pre>