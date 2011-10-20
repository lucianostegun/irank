//
//  RankingViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "RankingViewController.h"
#import "iRankAppDelegate.h"
#import "XMLRankingParser.h"
#import "Ranking.h"
#import "Constants.h"

@implementation RankingViewController
@synthesize appDelegate;
@synthesize detailViewController;
@synthesize userSiteId;
@synthesize datePicker;
@synthesize tableView;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    self.navigationController.navigationBar.tintColor = [UIColor blackColor];
    
    if( userSiteId==nil )
        userSiteId = [[NSUserDefaults standardUserDefaults] objectForKey:kUserSiteIdKey];
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://irank/index.php/ranking/getiPhoneAppXml/userSiteId/%@", userSiteId]];
    NSXMLParser *xmlParser = [[NSXMLParser alloc] initWithContentsOfURL:url];
    
    
    //Inicia o delegate
    XMLRankingParser *parser = [[XMLRankingParser alloc] initXMLParser];
    
    [xmlParser setDelegate:parser];
    
    if( appDelegate==nil )
        appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    //Inicia o parse do arquivo
    BOOL success = [xmlParser parse];
    
    for(Ranking *aRanking in appDelegate.rankingList) {
        
        aRanking.rankingName = [aRanking.rankingName stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
        aRanking.events      = [aRanking.events stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
        aRanking.players     = [aRanking.players stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
//        aRanking.rankingName = [aRanking.rankingName stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
    }
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}










#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    return [appDelegate.rankingList count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    
    cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
    
    Ranking *aRanking         = [appDelegate.rankingList objectAtIndex:indexPath.row];
    cell.textLabel.text       = aRanking.rankingName;
    cell.detailTextLabel.text = [NSString stringWithFormat:@"Membros: %@, Eventos: %@", aRanking.players, aRanking.events];
    
    // Configure the cell.
    return cell;
}

- (UITableViewCell *)tableView:(UITableView * )tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath {

    Ranking *aRanking = [appDelegate.rankingList objectAtIndex:indexPath.row];

    if( detailViewController==nil )
        detailViewController = [[RankingDetailViewController alloc] init];
    
	detailViewController.title = aRanking.rankingName;
    
    detailViewController.ranking = aRanking;
    
	[self.navigationController pushViewController:detailViewController animated:YES];
}

- (void)teste{
    
    NSLog(@"Passou no TESTE");
}




























- (void)dealloc {
 
    [appDelegate release];
    [detailViewController release];
    [userSiteId release];
    [tableView release];
    [super dealloc];
    
}

@end
