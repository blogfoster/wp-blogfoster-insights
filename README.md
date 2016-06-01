# blogfoster Insights WordPress plugin

This plugin integrates blogfoster Insights into your WordPress blog.

## Description

This plugin integrates blogfoster Insights into your WordPress blog. It
helps you to understand your blog and gives blogfoster the chance to offer you
the most suitable sponsored posts and campaigns. After you have configured the
plugin in the settings section, blogfoster Insights starts to work.

## Installation

### Install from WordPress Plugin Directory (recommended)

1. [Install the blogfoster Insights][004] plugin from the Plugin Directory
2. Activate the plugin in the Plugin dashboard
3. Go to 'blogfoster Insights'

### Uploading in WordPress Dashboard

1. [Download the `.zip` archive of the plugin from the releases page][001]
2. Navigate to the 'Add New' in the plugins dashboard
3. Navigate to the 'Upload' area
4. Select `wp-blogfoster-insights.zip` from your computer
5. Click 'Install Now'
6. Activate the plugin in the Plugin dashboard
7. Go to 'blogfoster Insights'

## Development

check all php files for correct syntax

```bash
make lint
```

create an archive of the plugin that can be uploaded

```bash
make zip
```

### docker-compose

- install docker and docker-compose
- run docker-compose commands to start the **wordpress** service

```bash
docker-compose pull
docker-compose build
docker-compose up -d
```

- wordpress should be available now at port **8080**

## Releasing

This Section describes how to create a new release for github and wordpress.com.

All development process should be reflected in this git repository first before pushing any changes to the
central wordpress.com svn repository!

### github

#### code changes

- create a feature branch from master
- do all your changes in the trunk directory
- run `make lint` to check that your php code is still valid
- see the development section how to run the plugin locally
- update the `Tested up to:` section in the [README.txt][006] if necessary
- create a pull request

#### releasing

- after a new pull request was merged describe the changes in the [CHANGELOG.md][007], [README.txt][006]
- update the `Stable tag:` section in the [README.txt][006] to the next version your going to publish
- update the version tag in [wp-blogfoster-insights.php][005]
- create a tag
- create a release, run `make zip`, and attach the generated **wp-blogfoster-insights.zip** to this release

### wordpress.com

After releasing a new version on github we should reflect these changes to the central wordpress.com svn repository.

- go into the [wp-blogfoster-insights][008] subdirectory where the **trunk** folder is located
- checkout the svn repository [https://plugins.svn.wordpress.org/wp-blogfoster-insights/][003]
- add all changes to to svn / mark all changes as resolved so that all changes from git are reflected to svn
- copy the trunk directory into the tags folder giving it the name of the latest tag (which we released on github)
- commit your changes (please contact your admin for the svn credentials)
- read the [wordpress svn getting started guide][002] if necessary

```bash
cd ./wp-blogfoster-insights
svn checkout https://plugins.svn.wordpress.org/wp-blogfoster-insights/
# svn stat / svn diff / svn add / svn resolved ...
# e.g. our last release on github was 1.0.1
svn cp trunk tags/1.0.1
svn commit -m '<commit message>' --username '<username>'
```

<!-- Links -->

[001]: https://github.com/blogfoster/wp-blogfoster-insights/releases/latest
[002]: https://wordpress.org/plugins/about/svn/
[003]: https://plugins.svn.wordpress.org/wp-blogfoster-insights/
[004]: https://wordpress.org/plugins/wp-blogfoster-insights/
[005]: wp-blogfoster-insights/trunk/wp-blogfoster-insights.php
[006]: wp-blogfoster-insights/trunk/README.txt
[007]: CHANGELOG.md
[008]: wp-blogfoster-insights/
