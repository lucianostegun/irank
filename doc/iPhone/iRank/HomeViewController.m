//
//  HomeViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "HomeViewController.h"
#import "iRankAppDelegate.h"
#import "Constants.h"

@implementation HomeViewController

@synthesize bankrollInfo;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
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
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    self.navigationItem.leftBarButtonItem = quitButton;
    

    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    NSMutableDictionary *userInfo = [[appDelegate userDefaults] objectForKey:@"userInfo"];
    
    bankrollInfo = [[NSMutableArray alloc] init];
    
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kBuyinsWord, kSelectKey,
                                 [userInfo valueForKey:kBuyinKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kFeeWord, kSelectKey,
                                 [userInfo valueForKey:kFeeKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kRebuysWord, kSelectKey,
                                 [userInfo valueForKey:kRebuyKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kAddonsWord, kSelectKey,
                                 [userInfo valueForKey:kAddonKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kPrizesWord, kSelectKey,
                                 [userInfo valueForKey:kPrizeKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kBalanceWord, kSelectKey,
                                 [userInfo valueForKey:kBalanceKey], kDescriptKey,
                                 nil, kControllerKey, nil]];    
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{

    return 3;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    int rows = 0;

    switch (section) {
        case 0:
            rows = 6;
            break;
        case 1:
            rows = 0;
            break;
        case 2:
            rows = 0;
            break;
        default:
            break;
    }
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleValue1 reuseIdentifier:CellIdentifier] autorelease];
    }
    

    
    NSDictionary *cellText = [bankrollInfo objectAtIndex:indexPath.row];
    
    NSString *label       = [cellText objectForKey:kSelectKey];
    NSString *description = [cellText objectForKey:kDescriptKey];

    cell.textLabel.text       = label;
    cell.detailTextLabel.text = description;
    
    NSPredicate *regExPredicate = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", @"^-.*$"];
    
    if( [regExPredicate evaluateWithObject:description] )
        cell.detailTextLabel.textColor = [UIColor redColor];
    
    cell.selectionStyle = UITableViewCellEditingStyleNone;
        
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    
    NSString *header = [[[NSString alloc] init] autorelease];
    
    switch (section) {
        case 0:
            header = @"Resumo geral";
            break;
        case 1:
            header = @"Próximos eventos";
            break;
        case 2:
            header = @"Últimos eventos";
            break;
        default:
            break;
    }
    
    return header;
}

- (NSString *)tableView:(UITableView *)tableView titleForFooterInSection:(NSInteger)section {
    
    NSString *footer = [[[NSString alloc] init] autorelease];
    
    switch (section) {
        case 0:
            footer = nil;
            break;
        case 1:
            footer = @"Nenhum evento agendado";
            break;
        case 2:
            footer = @"Nenhum evento realizado";
            break;
        default:
            break;
    }
    
    return footer;
}

/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/

/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source
        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
    }   
}
*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
}

#pragma mark - Custom actions

- (void)doLogout:(id)sender {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];

    [appDelegate showLogin];
        
    [[appDelegate userDefaults] removeObjectForKey:@"userInfo"]; 
    [[appDelegate userDefaults] synchronize];
}

- (void)dealloc {
    
    [bankrollInfo release];
    [super dealloc];
}
@end
